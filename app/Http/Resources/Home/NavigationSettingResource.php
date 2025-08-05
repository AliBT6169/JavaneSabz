<?php

namespace App\Http\Resources\Home;

use App\Http\Resources\Home\Settings\NavItemSettingAttributeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NavigationSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'link' => $this->link ?? '',
            'icon' => $this->icon,
            'queue' => $this->queue,
            'items' => $this->navItemSettingAttributes->count() > 0 ? NavItemSettingAttributeResource::collection($this->navItemSettingAttributes) : null,
        ];
    }
}
