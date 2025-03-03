<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $User = Auth::user();
        $userData = DashboardResource::make($User);
        return Inertia::render('Profile/Index', ['User' => $userData]);
    }
}
