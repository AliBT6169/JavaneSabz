<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\Home\Categories\indexCategoryResource;
use App\Http\Resources\Home\Product\HomeProductResource;
use App\Http\Resources\Home\Product\IndexProductVariationsResource;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Webmozart\Assert\Tests\StaticAnalysis\object;

class AttributeController extends Controller
{
    public function sendToShow(int $id, string $slug)
    {
        $Attribute = Attribute::whereId($id)->first();
        return to_route('attributes.show', ['name' => $Attribute->name, 'id' => $id, 'slug' => $Attribute->slug]);
    }

    public function show(string $name, int $id, string $slug)
    {
        $attribute = Attribute::whereId($id)
            ->with('brands', fn($query) => $query->where('is_active', true))
            ->with('categories', fn($query) => $query->where('is_active', true))
            ->with('products', fn($query) => $query->where('is_active', true)->with('product_variations'))
            ->with('product_variations', fn($query) => $query->where('is_active', true))
            ->first();
        return Inertia::render('Attribute', ['data' => [
            'brands' => BrandResource::collection($attribute->brands),
            'categories' => indexCategoryResource::collection($attribute->categories),
            'products' => HomeProductResource::collection($attribute->products),
            'allProducts' => IndexProductVariationsResource::collection($attribute->product_variations),
        ]]);

    }
}
