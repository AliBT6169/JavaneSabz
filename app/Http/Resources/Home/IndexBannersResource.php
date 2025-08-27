<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexBannersResource extends JsonResource
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
            'title' => $this->attribute->name,
            'icon' => $this->attribute->icon,
            'text' => $this->attribute->description,
            'slug' => $this->attribute->slug
        ];
    }
}
