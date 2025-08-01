<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Comments\AdminCommentsIndexResource;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Http\Resources\Admin\Transactions\TransactionIndexResource;
use App\Http\Resources\Admin\UserResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $dashboardData = [];
        $dashboardData['waitOrders'] = OrderIndexResource::collection(Order::where("status", 0)->where('payment_status', 1)->latest()->get());
        $dashboardData['niceSaleProducts'] = ProductVariationsResource::collection(ProductVariation::orderBy("sailed_quantity", "desc")->take(5)->get());
        $dashboardData['noQuantityProducts'] = ProductVariationsResource::collection(ProductVariation::where('quantity',0)->get());
        $dashboardData['newComments'] = AdminCommentsIndexResource::collection(Comment::orderBy("created_at", "desc")->take(5)->get());
        $dashboardData['newTransactions'] = TransactionIndexResource::collection(Transaction::orderBy("created_at", "desc")->take(5)->get());
        $dashboardData['mostBuyerUsers'] = UserResource::collection(User::orderBy("buy_item_quantity", "desc")->take(5)->get());
        return Inertia::render('Admin/Index', ['dashboardData' => $dashboardData]);
    }
}
