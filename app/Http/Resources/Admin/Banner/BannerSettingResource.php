<?php

namespace App\Http\Resources\Admin\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerSettingResource extends JsonResource
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
            'icon' => $this->attribute->icon ?? '',
            'attribute_id' => $this->attribute_id ?? '',
            'title' => $this->title ?? 'تنظیم نشده',
            'text' => $this->text ?? '',
        ];
    }
}
