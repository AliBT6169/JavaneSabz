<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\Product\IndexProductVariationsResource;
use App\Http\Resources\Home\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
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

    public function getData($id)
    {
        return response([
            'data' => ProductResource::make(ProductVariation::whereId($id)->first()),
            'status' => 200,
            'message' => 'success',
        ]);
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
    public function show(int $id, string $slug)
    {
        $product = ProductVariation::whereId($id)->first();
        if ($product->product->slug != $slug) {
            return Inertia::location(route('ProductShow', ['id' => $id, 'slug' => $product->product->slug]));
        }
        return Inertia::render('ProductShow', ["productData" => ProductResource::make($product)]);
    }

    public function showAll()
    {
        $variations = ProductVariation::where('is_active', true)->whereHas('product', function ($query) {
            $query->where('is_active', 1)->
            whereHas('brand', function ($query) {
                $query->where('is_active', 1);
            })->
            whereHas('category', function ($query) {
                $query->where('is_active', true);
            })->orderByDesc('sailed_quantity');
        })->get();
        $specials = $variations->filter(fn($variation) => $variation->is_special == true);
        $haveOffSale = $variations->filter(fn($variation) => $variation->off_sale > 1);
        $saleFulls = $variations->sortByDesc('sailed_quantity')->take(10);
        return Inertia::render('Products', ['data' => [
            "All" => IndexProductVariationsResource::collection($variations),
            "specials" => IndexProductVariationsResource::collection($specials),
            "havOffSale" => IndexProductVariationsResource::collection($haveOffSale),
            "saleFulls" => IndexProductVariationsResource::collection($saleFulls),
        ]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
