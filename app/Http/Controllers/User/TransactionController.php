<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
                Transaction::Creator();
                $response = [
                    'data' => '',
                    'status' => 200,
                    'message' => 'پرداخت موفق',
                ];
                break;
            case 2:
                $response = [
                    'data' => '',
                    'status' => 500,
                    'message' => 'پرداخت نامعلوم',
                ];
                break;
            case 3:
                $response = [
                    'data' => '',
                    'status' => 400,
                    'message' => 'پرداخت ناموفق',
                ];
                break;
        }
        return Inertia::render('Profile/Pages/Payment', ['response' => $response, 'order_id' => $order_id]);
    }
}
