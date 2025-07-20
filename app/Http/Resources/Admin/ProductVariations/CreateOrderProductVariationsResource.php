<?php

namespace App\Http\Resources\Admin\ProductVariations;

use App\Http\Resources\Gallery\GalleryResource;
use App\Models\DeliveryAmount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateOrderProductVariationsResource extends JsonResource
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
            'name' => $this->product->name,
            'value' => $this->value,
            'weight' => $this->weight,
            'delivery_amount' => DeliveryAmount::getPrice((int)$this->weight),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'off_sale' => $this->off_sale ?? 0,
            'sale_price' => $this->sale_price,
            'images' => $this->gallery->count() != 0 ? GalleryResource::collection($this->gallery) : $this->product->primary_image
        ];
    }
}
