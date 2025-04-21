<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Http\Resources\Home\ProductResource;
use App\Models\BuyCart\BuyCart;
use App\Models\DeliveryAmount;
use App\Models\Order;
use App\Models\ProductVariation;
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

    public function completePayment()
    {
        if (Auth::user()->address === null)
            return [
                'status' => 100,
                'message' => 'اطلاعات آدرس تکمیل نیست'
            ];
        if (Auth::user()->buy_carts->count() === 0)
            return [
                'status' => 100,
                'message' => 'محصولی در سبد خرید شما نیست'
            ];
        $deliveryAmount = DeliveryAmount::getOrderDeliveryAmount();
        $products = BuyCart::getUserProducts();
        $paying_amount = $products['total_price'] + $deliveryAmount['deliveryAmount'];
        $VAT = ($paying_amount * 9) / 100;

        Order::Creator([
            'total_amount' => (int)($products['total_price']),
            'delivery_amount' => $deliveryAmount['deliveryAmount'],
            'paying_amount' => (int)($paying_amount),
        ]);
        BuyCart::cartCleaner(Auth::id());
        return [
            'data'=>DashboardResource::getOrder(Auth::user()->orders),
            'products' => $products,
            'delivery_amount' => $deliveryAmount,
            'VAT' => (int)$VAT,
            'paying_amount' => (int)($paying_amount + $VAT),
        ];
    }

    public function UserCartChecker()
    {
        $cartItems = BuyCart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return response([
                'message' => 'سبد خرید شما خالی است.',
                'data' => [],
                'status' => 201
            ]);
        } else {

            foreach ($cartItems as $cartItem) {
                if ($cartItem->product_variation->quantity - $cartItem->quantity < 0)
                    return response([
                        'message' => 'موجودی محصول ' . $cartItem->product_variation->product->name . ' : ' . $cartItem->product_variation->value . ' کافی نیست',
                        'status' => 201,
                    ]);
            }
            //here is where payment done
            if (Order::Creator($cartItems) == 'OK') {
                foreach ($cartItems as $cartItem) {
                    ProductVariation::whereId($cartItem->product_variation_id)->decrement('quantity', $cartItem->quantity);
                    BuyCart::destroy($cartItem->id);
                }
                $data = [
                    'Orders' => DashboardResource::getOrder(Order::where('user_id', Auth::id())->get()),
                    'Transactions' => DashboardResource::getTransactions(Transaction::Where('user_id', Auth::id())->get()),
                ];
                return response([
                    'data' => $data,
                    'message' => 'پرداخت موفقیت آمیز بود',
                    'status' => 200
                ]);

            }
        }
    }
}
