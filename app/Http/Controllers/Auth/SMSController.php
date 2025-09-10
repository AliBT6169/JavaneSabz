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
        if (Cache::get($request->mobile . 'ban'))
            throw ValidationException::withMessages(['mobile' => 'تلاش های شما بیش از حد مجاز شد لطفا بعد از 20 دقیقه دوباره اقدام فرمایید!']);
        if (Cache::get($request->mobile . 'try')) {
            if (Cache::get($request->mobile . 'try') > 2) {
                Cache::put($request->mobile . 'ban', true, Date::now()->addMinutes(1));
                throw ValidationException::withMessages(['mobile' => 'تلاش های شما بیش از حد مجاز شد لطفا بعد از 20 دقیقه دوباره اقدام فرمایید!']);
            }
            Cache::put($request->mobile . 'try', Cache::get($request->mobile . 'try') + 1, Date::now()->addMinutes(1));
        } else {
            Cache::put($request->mobile . 'try', 1, Date::now()->addMinutes(10));
        }
        $code = rand(10000, 99999);
        $message = $code .' ' . '  :کد ورورد شما' . PHP_EOL . 'به سامانه جوانه سبز خوش آمدید' . PHP_EOL . 'لغو=11';
        Cache::put($request->mobile, $code, Date::now()->addMinutes(2));
        Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '19114303905',
            'password' => '#E2@Q',
            'to' => $request->mobile,
            'from' => '50002710003905',
            'text' => $message,

        ]);
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
        Cache::pull($request->mobile);
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
