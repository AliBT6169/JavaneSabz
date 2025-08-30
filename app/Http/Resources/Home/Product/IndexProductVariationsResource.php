<?php

namespace App\Http\Resources\Home\Product;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class IndexProductVariationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "category_id" => $this->product->category_id,
            "brand_id" => $this->product->brand_id,
            "slug" => $this->product->slug,
            "name" => $this->product->name,
            "value" => $this->value,
            "quantity" => $this->quantity,
            "old_price" => $this->price,
            "price" => $this->sale_price,
            "off_sale" => $this->off_sale,
            "image" => $this->gallery->count() != 0 ? $this->gallery[0]->media : $this->product->primary_image,
            "is_liked" => Auth::check() ? Wishlist::is_exist(Auth::user()->id, $this->id) : false,
        ];
    }
}
