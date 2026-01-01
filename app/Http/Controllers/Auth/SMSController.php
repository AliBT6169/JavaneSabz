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
        $userCheck = User::where('cellphone', $request->mobile)->first();
        if ($userCheck && $userCheck->is_admin) {
            return response()->json([
                'status' => 50,
            ]);
        }
        if ($userCheck && $userCheck->baned)
            throw ValidationException::withMessages(['message' => 'شما اجازه ورود ندارید!!!']);

        if (Cache::get($request->mobile . 'ban'))
            throw ValidationException::withMessages(['mobile' => 'تلاش های شما بیش از حد مجاز شد لطفا بعد از 20 دقیقه دوباره اقدام فرمایید!']);
        if (Cache::get($request->mobile . 'try')) {
            throw ValidationException::withMessages(['mobile' => 'لطفا برای ارسال مجدد کد 2 دقیقه صبر کنید']);

        } else {
            Cache::put($request->mobile . 'try', 1, Date::now()->addMinutes(2));
        }
        $code = rand(10000, 99999);
        $message = $code . ' ' . '  :کد ورورد شما' . PHP_EOL . 'به سامانه جوانه سبز خوش آمدید' . PHP_EOL . 'لغو=11';
//        $message = $code . ' ' . '  :کد ورورد شما' . PHP_EOL . 'به سامانه جوانه سبز خوش آمدید' . PHP_EOL . '@javane-sabz.com #' . $code . PHP_EOL . 'لغو=11';
        Cache::put($request->mobile, $code, Date::now()->addMinutes(2));
        $result = Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '19114303905',
            'password' => 'e769de5a-6382-414e-bbbf-35cbf68139df',
            'to' => $request->mobile,
            'from' => '30008810668877',
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
            if ($user->is_admin == 1)
                return redirect(route('admin.AdminDashboard'));
            else
                return redirect(route('dashboard', absolute: false));
        }
    }
}
