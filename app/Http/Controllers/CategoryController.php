<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\Categories\indexCategoryResource;
use App\Http\Resources\Home\Product\IndexProductVariationsResource;
use App\Models\category;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return indexCategoryResource::collection(Category::where('is_active', 1)->get());
    }

    public function productShow(int $category_id, string $slug)
    {
        $category = Category::whereId($category_id)->where('is_active', true)->first();
        if ($category) {
            if ($category->slug != $slug) {
                return Inertia::location(route('categories.show', ['id' => $category->id, 'slug' => $category->slug]));
            }
            $products = ProductVariation::whereHas('product',fn($query)=>$query->where('category_id', $category_id))->where('is_active', true)->get();
            $specials = IndexProductVariationsResource::collection($products->filter(fn($product) => $product->is_special == true));
            $haveOffSale = $products->filter(fn($product) => $product->off_sale > 1);
            $saleFulls = $products->sortByDesc('sailed_quantity')->take(10);
            return Inertia::render('Products', ['data' => [
                "All" => IndexProductVariationsResource::collection($products),
                "specials" => IndexProductVariationsResource::collection($specials),
                "havOffSale" => IndexProductVariationsResource::collection($haveOffSale),
                "saleFulls" => IndexProductVariationsResource::collection($saleFulls),
            ]]);
        } else
            return Inertia::render('404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
