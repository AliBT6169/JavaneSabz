<?php

namespace App\Http\Resources\Home;

use App\Models\ProductVariation;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
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
            'name' => $this->product->name,
            'value' => $this->value,
            'category' => [
                'name' => $this->product->category->name,
                'id' => $this->product->category->id,
            ],
            'brand' => [
                'name' => $this->product->brand->name,
                'id' => $this->product->brand->id,
            ],
            'images' => $this->imageHandler($this->gallery),
            'description' => $this->product->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'off_sale' => $this->off_sale,
            'sale_price' => $this->sale_price,
            'comments' => '',
            "is_liked" => Auth::check() ? Wishlist::is_exist(Auth::user()->id, $this->id) : false,
            'rate' => '',
            'sameProducts' => ProductVariation::getSomeProduct(10, $this->product->category->id),
        ];
    }

    public function getSomeSameProduct(int $categoryId)
    {

    }

    public function imageHandler($images): array
    {
        $result = [];
        foreach ($images as $image) {
            $result[] = [
                'image' => $image->media,
            ];
        }
        return $result;
    }
}
