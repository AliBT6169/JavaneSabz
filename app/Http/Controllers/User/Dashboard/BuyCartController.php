<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BuyCart\BuyCart;

class BuyCartController extends Controller
{
//    incrementing custom cart item quantities
    public function CartItemIncrement(int $id): void
    {
        BuyCart::whereId($id)->increment('quantity');
    }

//    decrementing custom cart item quantities
    public function CartItemDecrement(int $id): void
    {
        BuyCart::whereId($id)->decrement('quantity');
    }
}
