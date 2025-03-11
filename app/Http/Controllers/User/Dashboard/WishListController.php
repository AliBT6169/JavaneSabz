<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;

class WishListController extends Controller
{
    public function store($product_id, $user_id)
    {
        if (!Wishlist::is_exist($product_id, $user_id)) {
            $product = Wishlist::create([
                'user_id' => $user_id,
                'product_variation_id' => $product_id
            ]);
            $product = [
                "id" => $product->productVariation->id,
                "name" => $product->productVariation->product->name,
                "image" => $product->productVariation->product->primary_image,
                "price" => $product->productVariation->sale_price,
                "is_liked" => true,
            ];
            return $product;
        }
    }

    public function destroy($product_id, $user_id)
    {
        return WishList::where('product_variation_id', $product_id)->where('user_id', $user_id)->delete();
    }
}
