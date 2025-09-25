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
use Illuminate\Support\Facades\Log;
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
            Cache::put($request->mobile . 'try', Cache::get($request->mobile . 'try') + 1, Date::now()->addMinutes(2));
        } else {
            Cache::put($request->mobile . 'try', 1, Date::now()->addMinutes(10));
        }
        $code = rand(10000, 99999);
        $message = $code . ' ' . '  :کد ورورد شما' . PHP_EOL . 'به سامانه جوانه سبز خوش آمدید' . PHP_EOL . 'لغو=11';
        Cache::put($request->mobile, $code, Date::now()->addMinutes(2));
//        Http::post('https://console.melipayamak.com/api/send/shared/757ea766af2446918fa2bb00086b42a8', [
//            'username' => '19114303905',
//            'password' => '#E2@Q',
//            'to' => $request->mobile,
//            'from' => '50002710003905',
//            'text' => $message,
//
//        ]);
        $url = 'https://console.melipayamak.com/api/send/simple/757ea766af2446918fa2bb00086b42a8';
        $data = array('from' => '30008810668877', 'to' => $request->mobile, 'text' => $message);
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        Log::info($result);
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
            if ($user->is_admin == 1)
                return redirect(route('admin.AdminDashboard'));
            else
                return redirect(route('dashboard', absolute: false));
        }
    }
}
