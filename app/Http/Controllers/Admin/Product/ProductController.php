<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductsResource::collection(Product::paginate(20));
        return Inertia::render('Admin/pages/Products/index', ['products' => $products]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Products/create');
    }

    public function store(ProductStoreRequest $request)
    {
        if ($request->variation == '')
            abort(400, 'ساخت حداقل یک سایز از این محصول نیاز است!');
        if (!isset($request->variation[0]['image']))
            abort(400, 'عکس برای اندازه محصول الزامی است!');
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
                'value' => $variation['value'],
                'weight' => $variation['weight'],
                'price' => $variation['price'],
                'quantity' => $variation['quantity'],
                'off_sale' => $variation['off_sale'] ?? 0,
                'sale_price' => $salePrice,
            ]);
            foreach ($variation['image'] as $variationImage) {
                Gallery::updateImage(ProductVariation::class, $variationImage, $productVariation->id);
            }
        }

        return [
            'message' => 'محصول با موفقیت ساخته شد',
            'status' => '200',
        ];
    }
}
