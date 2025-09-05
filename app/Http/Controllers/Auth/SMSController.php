<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    public function sendAuthSMS(Request $request)
    {
        $code = rand(10000, 99999);
        Cache::put($request->mobile, $code, 5);
        $response = Http::post('http://payamak-service.ir/SendService.svc?wsdl',
            [
                'UserName' => 'mojtaba_70',
                'Password' => '@mojtaba4220',
                'From' => 'News',
                'To' => $request->mobile,
                'Message' => 'کد ورورد:' . $code . PHP_EOL . 'به جوانه سبز خوش آمدید',
            ]);
        $user = User::where('cellphone', $request->mobile)->first();
        if ($user) {
            return response()->json([
                'mobile' => $user->cellphone,
                'user_exists' => true,
                'response' => $response,
            ]);
        } else return response()->json([
            'mobile' => $request->mobile,
            'user_exists' => false,
            'response' => $response,
        ]);
    }

    public function codeValidation(Request $request)
    {
        $code = Cache::get($request->mobile);
        if ($request->code != $code) {
            return  response()->json(['code' => Cache::has($request->mobile)]);
        }
        if (isset($request->name)) {
            $user = User::create([
                'name' => $request->name,
                'full_name' => $request->full_name,
                'cell_phone' => $request->mobile
            ]);


            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));

        } else {
            $user = User::where('cell_phone', $request->mobile)->first();
            event(new Registered($user));
            Auth::login($user);
            return redirect(route('dashboard', absolute: false));
        }
    }
}
