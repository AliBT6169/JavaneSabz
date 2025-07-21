<?php

namespace App\Http\Resources\Admin\Transactions;

use App\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionOrderItemsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->product_variation->product->name,
            'value' => $this->product_variation->value,
            'images' => $this->product_variation->gallery->count() != 0 ? GalleryResource::collection($this->product_variation->gallery) : $this->product_variation->product->primary_image,
            'weight' => $this->quantity * $this->product_variation->weight,
            'price' => $this->price,
            'count' => $this->quantity,
        ];
    }
}
