<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Models\Order;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $dashboardData = [];
        $dashboardData['waitOrders'] = OrderIndexResource::collection(Order::where("status", 0)->where('payment_status', 1)->latest()->get());
        $dashboardData['niceSaleProducts'] = ProductVariationsResource::collection(ProductVariation::orderBy("sailed_quantity", "desc")->take(1)->get());
        return Inertia::render('Admin/Index', ['dashboardData' => $dashboardData]);
    }
}
