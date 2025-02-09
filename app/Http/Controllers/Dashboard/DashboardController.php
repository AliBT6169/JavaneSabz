<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $User = Auth::user();
        $UserAdress = UserAddress::get()->where('user_id', $User->id);
        $data = [
            'user' => $User,
            'user_address' => $UserAdress
        ];
        return Inertia::render('Profile/Index', ['User' => $data]);
    }
}
