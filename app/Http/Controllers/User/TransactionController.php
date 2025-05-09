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
        if (ProductVariation::productQuantityControl($order_id)['status'] === 400) {
            $data = DashboardResource::getTransactions([Transaction::Creator([
                'order_id' => $order_id,
                'status' => 3
            ])]);
            return Inertia::render('Profile/Pages/Payment', ['transaction_data' => $data]);
        }
        $response = [];
        switch (rand(1, 3)) {
            case 1:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 1,
                ];
                ProductVariation::productQuantityDecrement($order_id);
                break;
            case 2:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 2,
                ];
                break;
            case 3:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 3,
                ];;
                break;
        }
        $data = DashboardResource::getTransactions([Transaction::Creator($transaction_data)]);

        return Inertia::render('Profile/Pages/Payment', ['transaction_data' => $data]);
    }
}
