<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'is_admin' => $this->is_admin,
            'name' => $this->name,
            'full-name' => $this->full_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'user_address' => $this->address->address,
            'user_post_code' => $this->address->postcode,

        ];
    }
}
