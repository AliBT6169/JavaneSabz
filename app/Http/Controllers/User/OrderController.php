<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderCancellingRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function Cancellation(OrderCancellingRequest $request)
    {

        $user = Auth::user();
        $order = Order::whereId($request->order_id)->where('user_id', $user->id)->first();
        if ($order === null)
            abort(400, 'سفارش مورد نظر وجود ندارد');
        if ($order->status !== 0)
            abort(400, 'امکان لغو سفارش بعد از تائید سفارش توسط مدیر وجود ندارد');
        if ($order->payment_status == 0) {
            $order->update([
                'status' => 4,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'عملیات لغو سفارش موفقیت آمیز بود!',
            ]);
        }
        if ($request->card_number === null)
            abort(400, 'لطفا جهت بازگشت وجه شماره کارت خود را وارد نمایید');
        $order->update([
            'status' => 4,
        ]);
        Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '19114303905',
            'password' => '#E2@Q',
            'to' => $user->cellphone,
            'from' => '50002710003905',
            'text' => 'سفارش شما با کد :' . $order->coede . 'با موفقیت لغو شد' . PHP_EOL . PHP_EOL . 'طی 72 ساعت کاری آینده مبلغ به حساب شما عودت داده می گردد.' . PHP_EOL .
                'لغو: 11',
        ]);
        Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '19114303905',
            'password' => '#E2@Q',
            'to' => '09012553051',
            'from' => '50002710003905',
            'text' => 'کاربر' . $user->full_name . 'سفارش خود را با کد سفارش  ' . $order->code . '  بعد از پرداخت وجه لغو نمود ' . PHP_EOL .
                ' مبلغ جهت عودت وجه ' . $order->paying_amount . ' تومان میباشد.' . PHP_EOL .
                'شماره کارت کاربر: ' . $request->card_number . PHP_EOL . ' لطفا تا 72 ساعت کاری آینده مبلغ مذکور را به حساب کاربر عودت دهید',
        ]);
    }
}
