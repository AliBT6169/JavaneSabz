<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $transaction_data = null;
        $message = null;
        switch (rand(0, 2)) {
            case 2:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 2,
                ];
                ProductVariation::productQuantityDecrement($order_id);
                ProductVariation::sailedQuantityIncrement($order_id);
                Order::whereId($order_id)->update([
                    'payment_status' => 1,
                    'status' => 0
                ]);
                $message = 'تراکنش موفقیت آمیز بود';
                break;
            case 1:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 1,
                ];
                $message = 'تراکش نامعلوم';
                break;
            case 0:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 0,
                ];
                $message = 'تراکنش ناموفق بود';
                break;
        }
        $data = DashboardResource::getTransactions([Transaction::Creator($transaction_data)]);

        return Inertia::render('Profile/Pages/Payment', ['transaction_data' => $data, 'message' => $message]);
    }
}
