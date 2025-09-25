<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Comments\AdminCommentsIndexResource;
use App\Http\Resources\Admin\NotificationResource;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Http\Resources\Admin\Transactions\TransactionIndexResource;
use App\Http\Resources\Admin\UserResource;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $dashboardData = [];
        $dashboardData['selfData'] = DashboardResource::make(Auth::user());
        $dashboardData['waitOrders'] = OrderIndexResource::collection(Order::where("status", 0)->where('payment_status', 1)->latest()->get());
        $dashboardData['niceSaleProducts'] = ProductVariationsResource::collection(ProductVariation::orderBy("sailed_quantity", "desc")->take(5)->get());
        $dashboardData['noQuantityProducts'] = ProductVariationsResource::collection(ProductVariation::where('quantity', 0)->get());
        $dashboardData['newComments'] = AdminCommentsIndexResource::collection(Comment::orderBy("created_at", "desc")->take(5)->get());
        $dashboardData['newTransactions'] = TransactionIndexResource::collection(Transaction::orderBy("created_at", "desc")->take(5)->get());
        $dashboardData['mostBuyerUsers'] = UserResource::collection(User::orderBy("buy_item_quantity", "desc")->take(5)->get());
        $dashboardData['unSeenNotifications'] = $this->notificationService->getUnseensCount();
        return Inertia::render('Admin/Index', ['dashboardData' => $dashboardData]);
    }
}
