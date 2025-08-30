<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexSliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->attribute->id,
            'slug' => $this->attribute->slug,
            'name' => $this->attribute->name,
            'image' => $this->attribute->icon,
            'description' => $this->attribute->description,
        ];
    }
}
