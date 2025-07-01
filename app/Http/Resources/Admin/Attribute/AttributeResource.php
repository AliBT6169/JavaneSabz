<?php

namespace App\Http\Resources\Admin\Attribute;

use App\Http\Resources\Admin\Brands\BrandResource;
use App\Http\Resources\Admin\Categories\CategoryResource;
use App\Http\Resources\Admin\Products\ProductsResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description ?? '',
            'is_active' => $this->is_active,
            'brands' => BrandResource::collection($this->brands),
            'categories' => CategoryResource::collection($this->categories),
            'products' => ProductsResource::collection($this->products),
            'product_variations' => ProductVariationsResource::collection($this->product_variations),
        ];
    }
}
