<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Transactions\TransactionIndexResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = TransactionIndexResource::collection(Transaction::latest()->paginate(10));
        return Inertia::render('Admin/pages/Transactions/index', ['transaction_data' => $transaction]);
    }
}
