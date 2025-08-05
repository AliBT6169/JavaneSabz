<?php

namespace App\Http\Resources\Home\Brands;

use App\Http\Resources\Home\Product\HomeProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class indexBrandsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name"=>$this->name,
            "icon" => $this->icon,
            'products' => $this->products->count() > 0 ? HomeProductResource::collection($this->products) : null,
        ];
    }
}
