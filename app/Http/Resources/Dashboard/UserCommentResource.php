<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\Gallery\GalleryResource;
use App\Http\Resources\Home\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class UserCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => [
                'id' => $this->product_variation->id,
                'name' => $this->product_variation->product->name,
                'value' => $this->product_variation->value,
                'image' => $this->product_variation->gallery->count() != 0 ? GalleryResource::collection($this->product_variation->gallery) : [['image'=>$this->product_variation->product->primary_image]]
            ],
            'comment' => $this->comment,
            'status' => $this->approved,
            'created_at'=> Jalalian::fromDateTime($this->created_at)->format('l, d F Y H:i:s'),
        ];
    }
}
