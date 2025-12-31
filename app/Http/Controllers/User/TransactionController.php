<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function paymentPage($order_id)
    {
        $quantityCheck = ProductVariation::productQuantityControl($order_id);
        if ($quantityCheck['status'] === 400) {
            $data = DashboardResource::getTransactions([Transaction::Creator([
                'order_id' => $order_id,
                'status' => 0
            ])]);
            return Inertia::render('Profile/Pages/Payment', ['transaction_data' => $data, 'message' => $quantityCheck['message']]);
        }
        $amount = Order::find($order_id)->paying_amount;
        if (Auth::user()->is_admin)
            $amount = 1000;
        $response = Http::post('https://gateway.zibal.ir/v1/request', [
            'merchant' => '694f605e71bbfa002964ac4b',
            'amount' => $amount * 10,
            'callbackUrl' => route('pay.ZibalCallBack'),
            'orderId' => $order_id,
        ]);
        Transaction::query()->create([
            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'track_id' => $response['trackId'],
            'gateway_name' => 'zibal',
            'status' => 1,
        ]);
        return Inertia::render('ContinueToPayment', ['payment_amount' => $amount, 'order_id' => $order_id]);
    }

    public function ZibalPayPage(int $orderId)
    {
        $order = Order::query()->find($orderId);
        if (!$order) abort(404);
        $transaction = Transaction::query()->where('order_id', $orderId)->latest()->first();
        if (!$transaction) abort(404);
        return redirect()->away('https://gateway.zibal.ir/start/' . $transaction->track_id);
    }
}
