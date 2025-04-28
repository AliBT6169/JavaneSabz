<?php

namespace App\Http\Controllers;

use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function CouponChecker(Request $request)
    {
        $validation = $request->validate([
            'id' => 'required|numeric',
            'coupon_code' => 'required|string|exists:coupons,code|min:5|max:15',
        ]);
        $coupon = Coupon::where('code', $validation['coupon_code'])
            ->where('couponable_id', Auth::id())
            ->where('couponable_type', User::class)->first();
        if (!$coupon)
            return abort('404', 'کد مورد نظر یافت نشد');
        if ($coupon->status == 0 || $coupon->expired_at < Carbon::today())
            return abort(404, 'کد تخفیف منقضی شده');
        $Order = null;
        if ($validation['id'] == -1)
            $Order = Order::latest()->first();
        else
            $Order = Order::whereId($validation['id'])->first();
        $couponAmount = ($Order->paying_amount * $coupon->percentage) / 100;
        $paying_amount = 0;
        if ($coupon->max_amount <= $couponAmount)
            $couponAmount = $coupon->max_amount;
        $paying_amount = $Order->paying_amount - $couponAmount;
        Order::whereId($Order->id)->update([
            'paying_amount' => $paying_amount,
            'coupon_amount' => $couponAmount,
        ]);
        if ($coupon->quantity > 1)
            $coupon->update([
                'quantity' => $coupon->quantity - 1,
            ]);
        else
            $coupon->update([
                'status' => 0,
                'quantity' => 0,
            ]);
        return DashboardResource::getOrder(Auth::user()->orders);
    }
}
