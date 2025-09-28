<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminPasswordChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AdminPasswordChangeController extends Controller
{
    public function sendVerification()
    {
        if (Cache::get('adminPassChangeBan_' . Auth::user()->cellphone))
            throw ValidationException::withMessages(['message' => 'تلاش بیش از حد مجاز فردا تلاش کنید!']);
        $passChangeRequestCount = Cache::get('adminPassChange_' . Auth::user()->cellphone);
        if ($passChangeRequestCount >= 2) {
            Cache::put('adminPassChangeBan_' . Auth::user()->cellphone, 1, now()->addDays(1));
            throw ValidationException::withMessages(['message' => 'تلاش بیش از حد مجاز فردا تلاش کنید!']);
        }
        if ($passChangeRequestCount)
            Cache::put('adminPassChange_' . Auth::user()->cellphone, $passChangeRequestCount + 1, now()->addHour(1));
        if (!$passChangeRequestCount)
            Cache::put('adminPassChange_' . Auth::user()->cellphone, 1, now()->addHour(1));
        $code = rand(10000000, 99999999);
        Cache::put('adminPassChange_code' . Auth::user()->cellphone, $code, now()->addHour(1));
        $message = 'کد تغییر رمز عبور شما : ' . $code . PHP_EOL . 'لطفا این کد را در اختیار هیچ کس قرار ندهید';
        $result = Http::post('https://console.melipayamak.com/api/send/shared/757ea766af2446918fa2bb00086b42a8', [
            'username' => '19114303905',
            'password' => '#E2@Q',
            'to' => Auth::user()->cellphone,
            'from' => '30008810668877',
            'text' => $message,
        ]);
        return response()->noContent();
    }

    public function verifyAndChange(AdminPasswordChangeRequest $request)
    {
        if (Cache::get('adminPassChangeBan_' . Auth::user()->cellphone))
            throw ValidationException::withMessages(['message' => 'تلاش بیش از حد مجاز فردا تلاش کنید!']);
        $codeTestTries = Cache::get('adminPassChange_CodeTries_' . Auth::user()->cellphone);
        if ($codeTestTries > 1)
            Cache::put('adminPassChangeBan_' . Auth::user()->cellphone, 1, now()->addHour(1));
        if ($codeTestTries < 1)
            Cache::put('adminPassChange_CodeTries_' . Auth::user()->cellphone, $codeTestTries + 1, now()->addHour(1));
        if (!$codeTestTries)
            Cache::put('adminPassChange_CodeTries_' . Auth::user()->cellphone, 1, now()->addHour(1));
        if (!Hash::check($request->oldPassword, Auth::user()->password))
            throw ValidationException::withMessages(['message' => 'رمز  فعلی وارد شده اشتباه است!']);
        Auth::user()->update([
            'password' => $request->password
        ]);
        return response()->noContent();
    }
}
