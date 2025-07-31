<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
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
}
