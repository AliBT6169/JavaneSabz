<?php

namespace App\Http\Resources\Admin\Blog;

use App\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminBlogIndexResource extends JsonResource
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
            'title' => $this->title,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->name,
            ],
            'icon' => $this->icon,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
