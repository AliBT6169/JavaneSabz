<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function paymentPage($order_id)
    {
        $response = [];
        switch (rand(1, 3)) {
            case 1:
                $transaction_data = [
                    'order_id' => $order_id,
                    'status' => 1,
                ];
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
