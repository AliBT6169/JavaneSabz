<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductVariation;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function searchPage()
    {
        return Inertia::render('SearchPage');
    }

    public function search($input = '')
    {
        $productVariations = null;
        if ($input != '') {
            $products = Product::where('name', 'like', "%{$input}%")->get();
            $variations[] = ProductVariation::where('value', 'like', "%{$input}%")->get();
            foreach ($products as $product) {
                foreach ($product->product_variations as $variation) {
                    $variations = $variation;
                }
            }
            $productVariations = ProductResource::collection($variations);

        }
        return $productVariations;
    }
}
