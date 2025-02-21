<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function destroy($product_id, $user_id)
    {
        return WishList::where('product_variation_id', $product_id)->where('user_id', $user_id)->delete();
    }
}
