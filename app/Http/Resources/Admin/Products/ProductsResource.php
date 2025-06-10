<?php

namespace App\Http\Resources\Admin\Products;

use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'brand' => $this->brand->name,
            'category' => $this->category->name,
            'variations' => ProductVariationsResource::collection($this->product_variations),
            'image' => $this->primary_image,
            'is_active' => $this->is_active,
        ];
    }

    public static function getVariations($variations)
    {
        $data = [];
        foreach ($variations as $variation) {
            $data[] = [
                'name' => $variation->value,
            ];
        }
        return $data;

    }
}
