<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminSetAttributesToNavItemRequest;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Models\NavBarSetting;
use App\Models\NavItemSettingAttribute;
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
        $selectedItemAttributes = NavBarSetting::whereId($id)->first()->navItemSettingAttributes;
        $selectedAttributeIdes = [];
        $selectedAttributes = [];
        if ($selectedItemAttributes != null)
            foreach ($selectedItemAttributes as $itemAttribute) {
                $selectedAttributeIdes[] = $itemAttribute->attribute_id;
                $selectedAttributes[] = $itemAttribute->attribute;
            }
        $attributes = Attribute::whereNotIn('id', $selectedAttributeIdes)->get();
        return response()->json([
            'selectedAttributes' => $selectedAttributes,
            'Attributes' => AttributeResource::collection($attributes),
        ]);
    }

    public function setAttributeToNavItem(AdminSetAttributesToNavItemRequest $request)
    {
        $navItem = NavBarSetting::whereId($request['nav_id'])->first();
        if ($request['attributes'] == null)
            abort(500, 'حداقل یک خصوصیت را انتخاب کنید!');
        $attributes = $navItem->navItemSettingAttributes;
        if ($attributes->count() > 0) {
            foreach ($attributes as [$attribute, $index]) {
                $attributes[$index] = $attribute;
            }
        }
        foreach ($request['attributes'] as $attribute) {
            NavItemSettingAttribute::create([
                'nav_bar_setting_id' => $request['nav_id'],
                'attribute_id' => $attribute['id'],
            ]);
        }

        return response()->json('عملیات موفقیت آمیز بود');
    }
}
