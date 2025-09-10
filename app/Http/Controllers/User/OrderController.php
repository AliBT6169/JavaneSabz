<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Cancellation(int $id)
    {
        $user = Auth::user();
        $order = Order::whereId($id)->where('user_id', $user->id)->first();
        if ($order === null)
            abort(400, 'سفارش مورد نظر وجود ندارد');
        if ($order->status !== 0)
            abort(400, 'امکان لغو سفارش بعد از تائید سفارش توسط مدیر وجود ندارد');
        $order->update([
            'status' => 4,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'عملیات لغو سفارش موفقیت آمیز بود!',
        ]);
    }
}
