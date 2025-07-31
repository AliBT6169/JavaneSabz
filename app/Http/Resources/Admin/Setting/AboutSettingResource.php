<?php

namespace App\Http\Resources\Admin\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'address' => $this->address ?? '',
            'phone' => $this->phone ?? '',
            'icon' => $this->icon ?? '/logo/logo1.png',
            'email' => $this->email ?? '',
            'about' => $this->about ?? '',
            'facebook' => $this->facebook ?? '',
            'twitter' => $this->twitter ?? '',
            'instagram' => $this->instagram ?? '',
            'youtube' => $this->youtube ?? '',
            'telegram' => $this->telegram ?? '',
            'whatsapp' => $this->whatsapp ?? '',
            'eta' => $this->eta ?? '',
        ];
    }
}
