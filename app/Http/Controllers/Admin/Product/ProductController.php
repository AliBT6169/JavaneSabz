<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Models\Product;
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
        $variations = [];
        foreach ($request->variation as $variation) {
            $variations [] = $variation;
        }
        return $variations;
        Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'slug' => $request->name,
            'primary_image' => null,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        return $request;
    }
}
