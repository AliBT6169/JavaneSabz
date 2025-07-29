<?php

namespace App\Http\Controllers\Admin\ProductVariation;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function show()
    {
        return response()->json(ProductVariationsResource::collection(ProductVariation::latest()->get()), 200);
    }

    public function Increment(int $id)
    {
        ProductVariation::whereId($id)->increment('quantity');
    }

    public function Decrement(int $id)
    {
        if (ProductVariation::whereId($id)->first()->quantity > 0)
            ProductVariation::whereId($id)->decrement('quantity');
        else
            abort(500, 'مقدار محصول 0 شده است!');
    }
}
