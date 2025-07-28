<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $setting = '';
        return Inertia::render('Admin/pages/Settings/index', ['settings' => $setting]);
    }
}
