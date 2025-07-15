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
            'product_id' => $this->product_variation_id,
            'product_image' => $this->productVariation->gallery->count() != 0 ? $this->productVariation->gallery[0]->media : $this->productVariation->product->primary_image,
            'product_name' => $this->productVariation->product->name,
            'product_value' => $this->productVariation->value,
            'product_weight' => $this->productVariation->weight,
        ];
    }
}
