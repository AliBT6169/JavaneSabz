<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Http\Resources\Home\ProductResource;
use App\Models\BuyCart\BuyCart;
use App\Models\Coupon;
use App\Models\DeliveryAmount;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function completeCart()
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
        $quantity_check = ProductVariation::productQuantityControl();
        if ($quantity_check['status'] === 400)
            return [
                'status' => 100,
                'message' => $quantity_check['message']
            ];
        $deliveryAmount = DeliveryAmount::getOrderDeliveryAmount();
        $products = BuyCart::getUserProducts();
        $total_amount = $products['total_price'];
        $paying_amount = $total_amount + $deliveryAmount['deliveryAmount'];
        $VAT = ($total_amount * 9) / 100;
        $paying_amount = $paying_amount + $VAT;
        Order::Creator([
            'total_amount' => (int)($total_amount),
            'delivery_amount' => $deliveryAmount['deliveryAmount'],
            'paying_amount' => (int)($paying_amount),
            'VAT' => $VAT,
        ]);
        $paying_amount = $total_amount + $VAT;
        BuyCart::cartCleaner(Auth::id());
        return DashboardResource::getOrder(Auth::user()->orders);
    }

}
