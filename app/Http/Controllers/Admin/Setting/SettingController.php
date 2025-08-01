<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminSettingUpdateRequest;
use App\Http\Resources\Admin\Setting\AboutSettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $setting = [];
        $setting['AboutSetting'] = AboutSettingResource::make(Setting::first());
        return Inertia::render('Admin/pages/Settings/index', ['settings' => $setting]);
    }

    public function update(AdminSettingUpdateRequest $request)
    {
        $setting = Setting::first();
        $URL = '';
        if ($request->hasFile('icon')) {
            if ($setting->icon !== '/images/default/logo.png') {
                unlink(public_path($setting->icon));
            }
            $icon = $request->file('icon');
            $URL = '/images/logo/' . $setting->id . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('/images/logo/'), $setting->id . '.' . $icon->getClientOriginalExtension());
        }else{
            $URL = $setting->icon;
        }
        $setting->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'icon' => $URL,
            'email' => $request->email,
            'about' => $request->about,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'eta' => $request->eta,
        ]);
        return response()->json('عملیات موفقیت آمیز بود!', 200);
    }
}
