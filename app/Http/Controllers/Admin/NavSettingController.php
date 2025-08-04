<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
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

    public function queueToggle(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:nav_bar_settings,id',
            'state' => 'integer|in:-1,1',
        ]);

        $nav_item = NavBarSetting::whereId($request->id)->first();
        switch ($request->state) {
            case -1:
                if ($nav_item->queue > 0) {
                    NavBarSetting::where('queue', $nav_item->queue - 1)->first()->update([
                        'queue' => DB::raw('queue +1')
                    ]);
                    $nav_item->update([
                        'queue' => DB::raw('queue -1'),
                    ]);
                } else
                    abort(500, 'امکان عقب کشیدن این تب وجود ندارد!');
                break;
            case 1:
                if ($nav_item->queue < 4) {
                    NavBarSetting::where('queue', $nav_item->queue + 1)->first()->update([
                        'queue' => DB::raw('queue -1')
                    ]);
                    $nav_item->update([
                        'queue' => DB::raw('queue +1'),
                    ]);
                } else
                    abort(500, 'امکان جلو کشیدن این تب وجود ندارد!');
                break;
        }
        return response()->json([
            'message' => 'عملیات با موفقیت انجام شد!',
            'data' => NavBarSetting::OrderBy('queue', 'asc')->get(),
            'status' => 200
        ]);
    }

//    for nav items attributes selection
    public function geAttributes(int $id)
    {
        $selectedItemAttributes = NavBarSetting::whereId($id)->first()->navItemSettingAttributes();
        $selectedAttributeIdes = [];
        $selectedAttributes = [];
        if ($selectedItemAttributes->count() > 0)
            foreach ($selectedItemAttributes as $itemAttribute) {
                $selectedAttributeIdes[] = $itemAttribute->attribute_id;
                $selectedAttributes[] = $itemAttribute->attribute();
            }
        $attributes = Attribute::whereNotIn('id', $selectedAttributeIdes)->get();
        return response()->json([
            'selectedAttributes' => AttributeResource::collection($selectedAttributes),
            'Attributes' => AttributeResource::collection($attributes),
        ]);
    }
}
