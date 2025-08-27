<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getAttribute(int $id)
    {
        if (Banner::whereId($id)->first()->attribute)
            $attribute = AttributeResource::make(Banner::whereId($id)->first()->attribute);
        else
            $attribute = null;
        $attributes = AttributeResource::collection(Attribute::where('is_active', true)->whereNot('id',$attribute!=null?$attribute->id:0)->latest()->get());
        return response()->json([
            'attributes' => $attributes,
            'attribute' => $attribute,
        ]);
    }

    public function toggle(int $banner_id, int $attribute_id)
    {
        Banner::whereId($banner_id)->update(['attribute_id' => $attribute_id]);
        $attribute = AttributeResource::make(Banner::whereId($banner_id)->first()->attribute);
        $attributes = AttributeResource::collection(Attribute::where('is_active', true)->whereNot('id',$attribute_id)->latest()->get());
        return response()->json([
            'attributes' => $attributes,
            'attribute' => $attribute,
        ]);
    }
}
