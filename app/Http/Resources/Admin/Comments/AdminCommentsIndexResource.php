<?php

namespace App\Http\Resources\Admin\Comments;

use App\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

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
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'image' => $this->user->gallery->media ?? '/images/default/default.jpg',
            ],
            'product_variation' => [
                'id' => $this->product_variation_id,
                'name' => $this->product_variation->product->name,
                'value' => $this->product_variation->value,
                'image' => $this->product_variation->gallery->count() != 0 ? GalleryResource::collection($this->product_variation->gallery) : [['image' => '/images/default/product.png']],
            ],
            'comment' => $this->comment,
            'created_at' => Jalalian::fromDateTime($this->created_at)->format('l, d F Y H:i:s'),
            'approved' => $this->approved
        ];
    }
}
