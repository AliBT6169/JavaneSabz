<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
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
}
