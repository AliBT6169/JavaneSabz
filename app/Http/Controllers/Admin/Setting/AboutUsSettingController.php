<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminAboutUsSettingUpdateRequest;
use App\Models\AboutUsSetting;
use Illuminate\Http\Request;

class AboutUsSettingController extends Controller
{
    public function update(AdminAboutUsSettingUpdateRequest $request)
    {
        $aboutUsSetting = AboutUsSetting::first();
        $storeImagePath = '';
        $ownerImagePath = '';
        if ($request->hasFile('store_image')) {
            if ($aboutUsSetting->store_image !== '/images/default/about-us/store_image.jpg') {
                unlink(public_path($aboutUsSetting->store_image));
            }
            $storeImage = $request->file('store_image');
            $storeImagePath = '/images/about-us/store_image.' . $storeImage->getClientOriginalExtension();
            $storeImage->move(public_path('images/about-us/') , 'store_image.' . $storeImage->getClientOriginalExtension());
        } else
            $storeImagePath = $aboutUsSetting->store_image;
        if ($request->hasFile('owner_image')) {
            if ($aboutUsSetting->owner_image !== '/images/default/about-us/owner.jpg') {
                unlink(public_path($aboutUsSetting->owner_image));
            }
            $ownerImage = $request->file('owner_image');
            $ownerImagePath = '/images/about-us/owner.' . $ownerImage->getClientOriginalExtension();
            $ownerImage->move(public_path('images/about-us/') , 'owner.' . $ownerImage->getClientOriginalExtension());
        } else
            $ownerImagePath = $aboutUsSetting->owner_image;
        $aboutUsSetting->update([
            'owner_name' => $request->owner_name,
            'store_name' => $request->store_name,
            'store_image' => $storeImagePath,
            'owner_image' => $ownerImagePath,
            'description' => $request->description,
        ]);

        return response()->json('د!عملیات موفقیت آمیز بو');
    }
}
