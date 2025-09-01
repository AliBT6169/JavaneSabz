<?php

namespace App\Http\Resources\Home\Categories;

use App\Http\Resources\Home\Product\HomeProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class indexCategoryResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'icon' => $this->icon,
            'products' => $this->products->count() > 0 ? HomeProductResource::collection($this->products) : null,
        ];

    }
}
