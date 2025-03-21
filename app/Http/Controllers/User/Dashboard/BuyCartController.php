<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BuyCart\BuyCart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

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

    public function UserCartChecker()
    {
        $cartItems = BuyCart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {

            return response([
                'message' => 'is empty',
                'data' => [],
                'status' => 200
            ]);
        } else {
            //here is where payment done

            foreach ($cartItems as $cartItem) {
                BuyCart::destroy($cartItem->id);
            }
            return response([
                'data' => '',
                'message' => 'payment is successful',
                'status' => 200
            ]);
        }
    }
}
