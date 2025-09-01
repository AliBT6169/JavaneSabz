<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\Home\Product\IndexProductVariationsResource;
use App\Models\Brand;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
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
        return BrandResource::collection(Brand::where('is_active', 1)->get());
    }

    public function productsShow(int $brand_id, string $slug)
    {
        $brand = Brand::whereId($brand_id)->where('is_active', true)->first();
        if ($brand) {
            if ($brand->slug != $slug) {
                return Inertia::location(route('brands.show', ['id' => $brand->id, 'slug' => $brand->slug]));
            }
            $products = ProductVariation::whereHas('product',fn($query)=>$query->where('brand_id', $brand_id))->where('is_active', true)->get();
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
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
