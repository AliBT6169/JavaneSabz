<?php

namespace App\Http\Controllers\Dashboard\BuyCart;

use App\Http\Controllers\Controller;
use App\Models\BuyCart\BuyCart;
use Illuminate\Http\Request;

class BuyCartController extends Controller
{
    public function CartItemIncrement(int $id): void
    {
        BuyCart::whereId($id)->increment('quantity');
    }
    public function CartItemDecrement(int $id): void
    {
        BuyCart::whereId($id)->decrement('quantity');
    }
}
