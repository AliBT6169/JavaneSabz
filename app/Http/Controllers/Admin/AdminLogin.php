<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AdminLogin extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/AdminLogin');
    }

    public function store(AdminLoginRequest $request)
    {
        if (Cache::get('ban' . $request->userName))
            throw ValidationException::withMessages(['message' => 'تلاش بیش از حد مجاز لطفا بعدا تلاش کنید']);
        $tries = Cache::get('try_' . $request->userName);
        if ($tries > 3)
            Cache::put('ban' . $request->userName, 1, now()->addMinutes(20));
        if ($tries)
            Cache::put('try_' . $request->userName, $tries + 1, now()->addMinutes(20));
        else
            Cache::put('try_' . $request->userName, 1, now()->addMinutes(20));
        $admin = User::where('name', $request->userName)->first();
        if (!$admin)
            throw ValidationException::withMessages(['userName' => 'شما مجوز ورود به این صفحه را ندارید']);
        if (!Hash::check($request->password, $admin->password))
            throw ValidationException::withMessages(['password' => 'رمز عبور شما اشتباه است']);
        event(new Registered($admin));
        Auth::login($admin);
        return redirect()->route('admin.AdminDashboard');

    }
}
