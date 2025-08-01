<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AdminAboutUsSettingUpdateRequest;
use Illuminate\Http\Request;

class AboutUsSettingController extends Controller
{
    public function update(AdminAboutUsSettingUpdateRequest $request)
    {
        return $request;
    }
}
