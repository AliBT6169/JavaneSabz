<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendLoginMobileRequest;
use App\Http\Requests\SendVerifyCodeRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class SMSController extends Controller
{
    public function sendAuthSMS(SendLoginMobileRequest $request)
    {
        $code = rand(10000, 99999);
        Cache::put($request->mobile, $code, Date::now()->addMinutes(2));
        $user = User::where('cellphone', $request->mobile)->first();
        if ($user) {
            return response()->json([
                'mobile' => $user->cellphone,
                'user_exists' => true,
            ]);
        } else return response()->json([
            'mobile' => $request->mobile,
            'user_exists' => false,
        ]);
    }

    public function codeValidation(SendVerifyCodeRequest $request)
    {
        $code = Cache::get($request->mobile);
        if ($request->code != $code) {
           throw ValidationException::withMessages(['code' => 'کد وارد شده اشتباه است!']);
        }
        if (isset($request->name)) {
            $user = User::create([
                'name' => $request->name,
                'full_name' => $request->full_name,
                'cellphone' => $request->mobile
            ]);


            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));

        } else {
            $user = User::where('cellphone', $request->mobile)->first();
            event(new Registered($user));
            Auth::login($user);
            return redirect(route('dashboard', absolute: false));
        }
    }
}
