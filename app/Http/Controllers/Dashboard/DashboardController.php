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
        $userData = [
            'id' => $User->id,
            'is_admin' => $User->is_admin,
            'name' => $User->name,
            'full_name' => $User->full_name,
            'gender' => $User->gender,
            'email' => $User->email,
            'cellphone' => $User->cellphone,
            'created_at' => jalalian::fromDateTime($User->created_at)->format('d-m-Y H:i:s'),
            'user_address' => $User->address->address??null,
            'user_post_code' => $User->address->postcode??null,
        ];
        return Inertia::render('Profile/Index', ['User' => $userData]);
    }
}
