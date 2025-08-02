<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavBarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavSettingController extends Controller
{
    public function toggle(int $id)
    {
        NavBarSetting::whereId($id)->update([
            'is_active' => DB::raw('NOT is_active'),
        ]);
        return response()->json('عملیات موفقیت آمیز بود!');
    }
}
