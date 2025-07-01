<?php

namespace App\Http\Resources\Admin\Attribute;

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
            'brands_count' => $this->brands->count(),
            'categories_count' => $this->categories->count(),
            'products_count' => $this->products->count(),
            'product_variations_count' => $this->product_variations->count(),
        ];
    }
}
