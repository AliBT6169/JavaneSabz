<?php

namespace App\Http\Resources\Home\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'variations'=>IndexProductVariationsResource::collection($this->product_variations)
        ];
    }
}
