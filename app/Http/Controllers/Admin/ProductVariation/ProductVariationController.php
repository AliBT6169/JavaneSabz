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
}
