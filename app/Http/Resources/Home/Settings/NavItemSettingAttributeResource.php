<?php

namespace App\Http\Resources\Home\Settings;

use App\Http\Resources\Home\Brands\indexBrandsResource;
use App\Http\Resources\Home\Categories\indexCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NavItemSettingAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->attribute->name,
            'icon' => $this->attribute->icon,
            'description' => $this->attribute->description,
            'brands' => $this->attribute->brands->count() > 0 ? indexBrandsResource::collection($this->attribute->brands) : null,
            'categories' => $this->attribute->categories->count() > 0 ? indexCategoryResource::collection($this->attribute->categories) : null,
        ];
    }
}
