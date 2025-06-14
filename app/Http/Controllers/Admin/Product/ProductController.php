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
        $primaryImageURL = '/images/products/' . $request->name;
        $path = $image->move(public_path($primaryImageURL), $request->name . '.' . $image->getClientOriginalExtension());

        $product = Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'slug' => $request->name,
            'primary_image' => $primaryImageURL . '/' . $request->name . '.' . $image->getClientOriginalExtension(),
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

        $product = Product::whereId($request->id)->update([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'is_active' => $request->is_active,
            'slug' => $request->name,
            'description' => $request->description,
        ]);
        return ProductsResource::make(Product::whereId($request->id)->first());
    }
}
