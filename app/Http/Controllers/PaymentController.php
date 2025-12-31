<?php

namespace App\Http\Controllers;

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

class PaymentController extends Controller
{
    public function ZibalCallBack(Request $request)
    {
        $response = Http::post('https://gateway.zibal.ir/v1/verify', [
            'merchant' => '694f605e71bbfa002964ac4b',
            'trackId' => $request->trackId
        ]);
        $response = json_decode($response, true);
        $message = '';
        $transaction = Transaction::query()->where('track_id', $request->trackId)->first();
        switch ($response['status']) {
            case 1:
                $transaction->update([
                    'order_id' => $request->orderId,
                    'status' => 2,
                ]);
                $transaction->save();
                Auth::user()->update([
                    'buy_item_quantity' => DB::raw('buy_item_quantity +' . Order::whereId($request->orderId)->first()->orderItems->count())
                ]);
                ProductVariation::productQuantityDecrement($request->orderId);
                ProductVariation::sailedQuantityIncrement($request->orderId);
                Order::whereId($request->orderId)->update([
                    'payment_status' => 1,
                    'status' => 0
                ]);
                $message = 'تراکنش موفقیت آمیز بود';
                break;
            case 2:
                $transaction->update([
                    'order_id' => $request->orderId,
                    'status' => 1,
                ]);
                $transaction->save();
                $message = 'تراکش نامعلوم لطفا با پشتیبانی تماس حاصل فرمایید';
                break;
            default:
                $transaction->update([
                    'order_id' => $request->orderId,
                    'status' => 0,
                ]);
                $transaction->save();
                $message = 'تراکنش ناموفق بود';
                break;
        }
        $data = DashboardResource::getTransactions([$transaction]);
        return Inertia::render('Profile/Pages/Payment', ['transaction_data' => $data, 'message' => $message]);
    }
}
