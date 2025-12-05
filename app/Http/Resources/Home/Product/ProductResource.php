<?php

namespace App\Http\Resources\Home\Product;

use App\Http\Resources\Gallery\GalleryResource;
use App\Http\Resources\Home\Comment\ProductCommentsResource;
use App\Http\Resources\Home\EquipmentResource;
use App\Models\ProductVariation;
use App\Models\Rate;
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
            'images' => $this->gallery->count() > 0 ? GalleryResource::collection($this->gallery) : [0 => ['image' => $this->product->primary_image]],
            'description' => $this->product->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'equipments' => EquipmentResource::collection($this->product->Equipments),
            'off_sale' => $this->off_sale,
            'sale_price' => $this->sale_price,
            'comments' => ProductCommentsResource::collection($this->comments->where('approved', 1)),
            "is_liked" => Auth::check() ? Wishlist::is_exist(Auth::user()->id, $this->id) : false,
            'rate' => Rate::where('rateable_id', $this->id)->where('rateable_type', ProductVariation::class)->average('rate') ?? 0,
            'sameProducts' => ProductVariation::getSomeProduct(10, [
                'brand_id' => $this->product->brand->id,
                'category_id' => $this->product->category->id,
            ]),
        ];
    }

    public static function handleProduct($data): array
    {
        $productVariations = [];
        foreach ($data as $product) {
            foreach ($product->product_variations as $variation) {
                $productVariations[] = $variation;
            }
        }
        $result = [];
        foreach ($productVariations as $item) {
            $result[] = [
                "id" => $item->id,
                "product_id" => $item->product_id,
                "category_id" => $item->product->category_id,
                "brand_id" => $item->product->brand_id,
                "name" => $item->product->name,
                "value" => $item->value,
                "quantity" => $item->quantity,
                "price" => $item->sale_price,
                "image" => $item->product->primary_image,
                "is_liked" => Auth::check() ? Wishlist::is_exist(Auth::user()->id, $item->id) : false,
            ];
        }
        return $result;
    }

    public static function imageHandler($images): array
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
