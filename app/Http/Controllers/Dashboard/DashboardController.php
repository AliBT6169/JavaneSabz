<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function index()
    {
        $User = Auth::user();
//        return $User->buy_carts[0]->product_variation;
        $userData = DashboardResource::make($User);
        return Inertia::render('Profile/Index', ['User' => $userData]);
    }
}
