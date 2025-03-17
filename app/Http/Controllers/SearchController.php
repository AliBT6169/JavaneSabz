<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\ProductResource;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function searchPage()
    {
        return Inertia::render('SearchPage');
    }

    public function search($input = '')
    {
        if ($input != '') {
            $productVariations = ProductResource::collection(ProductVariation::where('value', 'like', "%{$input}%")->get());

            return [
                'productVariations' => $productVariations,
            ];
        }
    }
}
