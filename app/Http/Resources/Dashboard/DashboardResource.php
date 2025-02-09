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
            'id' => $this['user']->id,
            'is_admin' => $this['user']->is_admin,
            'name' => $this['user']->name,
            'full-name' => $this['user']->full_name,
            'gender' => $this['user']->gender,
            'email' => $this['user']->email,
            'created_at' => $this['user']->created_at,
            'user_address' => $this['user_address']->address,
            'user_post_code' => $this['user_address']->postcode,

        ];
    }
}
