<?php

namespace App\Http\Resources\Admin\Slider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminSliderSettingResource extends JsonResource
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
            'name' => $this->attribute->name,
            'icon' => $this->attribute->icon,
            'attribute_id' => $this->attribute_id,
            'status' => $this->status,
        ];
    }
}
