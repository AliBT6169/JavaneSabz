<?php

namespace App\Http\Resources\Admin\Comments;

use App\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCommentsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'image' => $this->user->gallery->media ?? '/images/defaults/default.jpg',
            ],
            'product_variation' => [
                'id' => $this->product_variation_id,
                'name' => $this->product_variation->product->name,
                'value' => $this->product_variation->value,
                'image' => isset($this->product_variation->gallery) ? GalleryResource::collection($this->product_variation->gallery) : '/images/defaults/default.jpg',
            ],
            'comment' => $this->comment,
            'approved' => $this->approved
        ];
    }
}
