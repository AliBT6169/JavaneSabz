<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->full_name??'',
            'user_name' => $this->name,
            'gender' => $this->gender,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
            'address' => $this->address->address ?? '',
            'postal_code' => $this->address->postcode ?? '',
        ];
    }
}
