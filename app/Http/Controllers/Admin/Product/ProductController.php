<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductUpdateRequest;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariation;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductsResource::collection(Product::latest()->paginate(20));
        return Inertia::render('Admin/pages/Products/index', ['products' => $products]);
    }

    public function active_deActive(int $id)
    {
        $productVariation = Product::whereId($id)->update([
            'is_active' => DB::raw('NOT is_active')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'عملیات موفقیت آمیز بود',
            'status' => 200
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Products/create');
    }

    public function store(ProductStoreRequest $request)
    {
        if ($request->variation == '')
            abort(400, 'ساخت حداقل یک سایز از این محصول نیاز است!');
        $image = $request->file('image');
        $primaryImageURL = '/images/products/' . Product::latest()->first()->id + 1;
        $path = $image->move(public_path($primaryImageURL), Product::latest()->first()->id + 1 . '.' . $image->getClientOriginalExtension());

        $product = Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'slug' => $request->name,
            'primary_image' => $primaryImageURL . '/' . Product::latest()->first()->id + 1 . '.' . $image->getClientOriginalExtension(),
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        foreach ($request->variation as $variation) {
            if ($variation['off_sale'] != null)
                $salePrice = $variation['price'] - ($variation['off_sale'] * $variation['price']) / 100;
            $productVariation = ProductVariation::create([
                'product_id' => $product->id,
                'value' => $variation['size'],
                'weight' => $variation['weight'],
                'price' => $variation['price'],
                'quantity' => $variation['quantity'],
                'off_sale' => $variation['off_sale'] ?? 0,
                'sale_price' => $salePrice,
            ]);
            if (isset($variation['image']['image0']))
                foreach ($variation['image'] as $variationImage) {
                    Gallery::updateImage(ProductVariation::class, $variationImage, $productVariation->id);
                }
        }

        return response()->json([
            'message' => 'محصول با موفقیت ساخته شد',
            'status' => '200',
        ]);
    }

    public function edit(int $id)
    {
        $product = ProductsResource::make(Product::whereId($id)->first());
        return Inertia::render('Admin/pages/Products/edit', ['Product' => $product]);
    }

    public function update(ProductUpdateRequest $request)
    {
        if ($request->variation == '')
            abort(400, 'داشتن حد اقل یک سایز ضروری است!');
        $product = Product::whereId($request->id)->first();
        $ImageURL = 'images/products/' . $product->id;
        $image = null;
        if ($request->image != null) {
            $image = $request->file('image');
            unlink(public_path($product->primary_image));
            $image->move(public_path($ImageURL), $product->id . '.' . $image->getClientOriginalExtension());
        }
        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'is_active' => $request->is_active,
            'primary_image' => $image != null ? '/' . $ImageURL . '/' . $product->id . '.' . $image->getClientOriginalExtension() : $product->primary_image,
            'slug' => $request->name,
            'description' => $request->description,
        ]);
        foreach ($product->product_variations as $variation) {
            $deleted_variation = true;
            foreach ($request->variation as $request_variation) {
                if ($variation->id == $request_variation['id']) {
                    $deleted_variation = false;
                }
            }
            if ($deleted_variation) {
                if ($variation->gallery() && File::exists(public_path('images/productVariations/' . $variation->id))) {
                    File::deleteDirectory(public_path('images/productVariations/' . $variation->id));
                }
                $variation->delete();

            }
        }
        foreach ($request->variation as $variation) {
            if ($variation['id'] == 0) {
                $salePrice = $variation['price'] - (($variation['off_sale'] ?? 0) * $variation['price'] / 100);
                $productVariation = ProductVariation::create([
                    'product_id' => $request->id,
                    'value' => $variation['size'],
                    'weight' => $variation['weight'],
                    'price' => $variation['price'],
                    'quantity' => $variation['quantity'],
                    'off_sale' => $variation['off_sale'] ?? 0,
                    'sale_price' => $salePrice,
                ]);
                if (isset($variation['image']['image0']))
                    foreach ($variation['image'] as $variationImage) {
                        Gallery::updateImage(ProductVariation::class, $variationImage, $productVariation->id);
                    }
            } else {
                $oldVariation = ProductVariation::whereId($variation['id'])->first();
                $salePrice = $variation['price'] - (($variation['off_sale'] ?? 0) * $variation['price'] / 100);
                $oldVariation->update([
                    'value' => $variation['size'],
                    'weight' => $variation['weight'],
                    'price' => $variation['price'],
                    'quantity' => $variation['quantity'],
                    'off_sale' => $variation['off_sale'] ?? 0,
                    'sale_price' => $salePrice,
                ]);
                $passedImage = $oldVariation->gallery;
                if ($passedImage != null) {
                    return $passedImage;
                }
            }
        }
        return ProductsResource::make($product);
    }
}
