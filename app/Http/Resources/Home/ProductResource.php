<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => [
                'name' => $this->product->category->name,
                'id' => $this->product->category->id,
            ],
            'brand' => [
                'name' => $this->product->brand->name,
                'id' => $this->product->brand->id,
            ],
            'images' => $this->gallery,
            'description' => $this->product->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'off_sale' => $this->off_sale,
            'sale_price' => $this->sale_price,
            'comments' => '',
            'rate' => '',
        ];
    }
}
