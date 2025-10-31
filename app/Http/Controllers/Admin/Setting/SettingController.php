<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminSettingUpdateRequest;
use App\Http\Resources\Admin\Banner\BannerSettingResource;
use App\Http\Resources\Admin\Setting\AboutSettingResource;
use App\Http\Resources\Admin\Setting\BestBrandsResource;
use App\Http\Resources\Admin\Slider\AdminSliderSettingResource;
use App\Models\AboutUsSetting;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\NavBarSetting;
use App\Models\Setting;
use App\Models\SliderSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $setting = [];
        $setting['AboutSetting'] = AboutSettingResource::make(Setting::first());
        $setting['AboutUsSetting'] = AboutUsSetting::first();
        $setting['NavSetting'] = NavBarSetting::orderBy('queue', 'asc')->get();
        $setting['BestBrandsSettings'] = BestBrandsResource::collection(Brand::orderBy('is_best', 'desc')->get());
        $setting['BannersSettings'] = BannerSettingResource::collection(Banner::latest()->get());
        $setting['SliderSettings'] = AdminSliderSettingResource::collection(SliderSettings::latest()->get());
        return Inertia::render('Admin/pages/Settings/index', ['settings' => $setting]);
    }

    public function update(AdminSettingUpdateRequest $request)
    {
        $setting = Setting::first();
        $URL = $setting->icon;
        if ($request->hasFile('icon')) {
            if ($setting->icon !== '/images/default/logo.png' && File::exists(public_path($URL)))
                unlink(public_path($setting->icon));
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $URL = '/images/logo/' . $iconName;
            $icon->move(public_path('/images/logo/'),$iconName);
        } else {
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
