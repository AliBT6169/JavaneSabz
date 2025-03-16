<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BuyCart\BuyCart;
use Illuminate\Support\Facades\Auth;

class BuyCartController extends Controller
{
//    incrementing custom cart item quantities
    public function CartItemIncrement(int $id): void
    {
        BuyCart::CartItemIncrement($id);
    }

//    decrementing custom cart item quantities
    public function CartItemDecrement(int $id)
    {

        return BuyCart::CartItemDecrement($id);
    }

    public function addToBuyCart(int $ProductId)
    {
        return BuyCart::addToCart($ProductId);
    }
}
