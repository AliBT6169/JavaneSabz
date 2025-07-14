<?php

namespace App\Http\Resources\Admin\OrderItem;

use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemIndexResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'product_variation' => ProductVariationsResource::make($this->productVariation),
        ];
    }
}
