<?php

namespace App\Http\Resources\Home\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_name' => $this->user->name ?? '',
            'user_image' => $this->user->gallery->media ?? '/images/default/default.jpg',
            'comment' => $this->comment ?? '',
        ];
    }
}
