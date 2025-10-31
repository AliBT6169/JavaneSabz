<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductStoreRequest;
use App\Http\Requests\Admin\Products\ProductUpdateRequest;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariation;
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
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $primaryImageURL = '/images/products/' . $imageName;
        $path = $image->move(public_path('images/products/'), $imageName);

        $product = Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'slug' => $request->name,
            'primary_image' => $primaryImageURL,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);
        $imageCount = 0;
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
                'is_active' => $variation['is_active'],
                'is_special' => $variation['is_special'],
            ]);
            foreach ($variation['image'] as $variationImage) {
                $variationImageName = time() . $imageCount . '.' . $variationImage->getClientOriginalExtension();
                Gallery::updateImage(ProductVariation::class, $productVariation->id, $variationImage, '/images/products/variations/', $variationImageName);
                $imageCount++;
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
//        check if have eny variations
        if ($request->variation == '')
            abort(400, 'داشتن حد اقل یک سایز ضروری است!');
//        product updating
        $product = Product::whereId($request->id)->with('product_variations')->first();
        $imagePath = $product->primary_image;
        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            if (File::exists(public_path($imagePath)))
                unlink(public_path($imagePath));
            $request->image->move(public_path('images/products/'), $imageName);
            $imagePath = '/images/products/' . $imageName;
        }

        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'is_active' => $request->is_active,
            'primary_image' => $imagePath,
            'slug' => $request->name,
            'description' => $request->description,
        ]);


//        deleting deleted variations
        foreach ($product->product_variations as $variation) {
            $deleted_variation = true;
            foreach ($request->variation as $request_variation) {
                if ($variation->id == $request_variation['id']) {
                    $deleted_variation = false;
                    break;
                }
            }
            if ($deleted_variation) {
                Gallery::deleteMedia($variation->id, ProductVariation::class);
                $variation->delete();
            }
        }

//        updating existing variation and add new variations
        foreach ($request->variation as $requestVariation) {
            if ($requestVariation['id'] == -1) {
//                new variations
                $salePrice = $requestVariation['price'] - (($requestVariation['off_sale'] ?? 0) * $requestVariation['price'] / 100);
                $productVariation = ProductVariation::create([
                    'product_id' => $product->id,
                    'value' => $requestVariation['size'],
                    'weight' => $requestVariation['weight'],
                    'price' => $requestVariation['price'],
                    'quantity' => $requestVariation['quantity'],
                    'is_active' => $requestVariation['is_active'],
                    'is_special' => $requestVariation['is_special'],
                    'off_sale' => $requestVariation['off_sale'] ?? 0,
                    'sale_price' => $salePrice,
                ]);
                if (isset($requestVariation['image']['image0']))
                    $imageCount = 0;
                foreach ($requestVariation['image'] as $variationImage) {
                    $requestVariationImageName = time() . $imageCount . '.' . $requestVariation['image']['image0']->getClientOriginalExtension();
                    Gallery::updateImage(ProductVariation::class, $productVariation->id, $variationImage, '/images/products/variations/', $requestVariationImageName);
                    $imageCount++;
                }
            } else {
//                old variations
                $oldVariation = ProductVariation::whereId($requestVariation['id'])->first();
                $salePrice = $requestVariation['price'] - (($requestVariation['off_sale'] ?? 0) * $requestVariation['price'] / 100);
                $oldVariation->update([
                    'value' => $requestVariation['size'],
                    'weight' => $requestVariation['weight'],
                    'price' => $requestVariation['price'],
                    'quantity' => $requestVariation['quantity'],
                    'is_active' => $requestVariation['is_active'],
                    'is_special' => $requestVariation['is_special'],
                    'off_sale' => $requestVariation['off_sale'] ?? 0,
                    'sale_price' => $salePrice,
                ]);
//                deleting passed image when admin deleted
                $passedImage = $oldVariation->gallery;
                if ($passedImage != null) {
                    if (isset($requestVariation['passed_image']))
                        foreach ($passedImage as $variationImage) {
                            $deleted = true;
                            foreach ($requestVariation['passed_image'] as $requestVariationPassedImage) {
                                if ($variationImage->id == $requestVariationPassedImage['id']) {
                                    $deleted = false;
                                    break;
                                }
                            }
                            if ($deleted) {
                                Gallery::deleteWithId($variationImage->id);
                            }
                        }
                    else Gallery::deleteMedia($oldVariation->id, ProductVariation::class);
                }

//                add new images
                if (isset($requestVariation['image']['image0'])) {
                    $counter = 0;
                    foreach ($requestVariation['image'] as $variationImage) {
                        $imageName = time() . $counter . '.' . $variationImage->getClientOriginalExtension();
                        Gallery::updateImage(ProductVariation::class, $oldVariation->id, $variationImage, '/images/products/variations/', $imageName);
                        $counter++;
                    }
                }
            }
        }
        return ProductsResource::make($product);
    }

    public function destroy(int $id)
    {
        $product = Product::whereId($id)->first();
        if (File::exists(public_path($product->primary_image)))
            unlink(public_path($product->primary_image));
        foreach ($product->product_variations as $variation) {
            Gallery::deleteMedia($variation->id, ProductVariation::class);
            $variation->delete();
        }
        $product->delete();
        return response()->noContent();
    }

    public function show()
    {
        return response()->json(ProductsResource::collection(Product::latest()->get()), 200);
    }

    public function search(string $name)
    {
        $products = null;
        if ($name != '~')
            $products = Product::where('name', 'like', '%' . $name . '%')->latest()->paginate(20);
        else
            $products = Product::latest()->paginate(20);
        return response()->json(ProductsResource::collection($products), 200);
    }
}
