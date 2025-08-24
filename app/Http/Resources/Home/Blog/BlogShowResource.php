<?php

namespace App\Http\Resources\Home\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class BlogShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'views' => $this->views,
            'description' => $this->description,
            'created_at' => Jalalian::fromDateTime($this->created_at)->format('l, d F Y H:i:s'),
        ];
    }
}
