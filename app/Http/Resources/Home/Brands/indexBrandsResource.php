<?php

namespace App\Http\Resources\Home\Brands;

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
            "icon" => $this->icon,
        ];
    }
}
