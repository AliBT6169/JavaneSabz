<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Http\Resources\Admin\Slider\AdminSliderSettingResource;
use App\Models\Attribute;
use App\Models\SliderSettings;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\object;

class SliderSettingController extends Controller
{
    public function getAttribute(int $id)
    {
        if ($id != 0 && SliderSettings::whereId($id)->first()->attribute)
            $attribute = AttributeResource::make(SliderSettings::where('id', $id)->first()->attribute);
        else
            $attribute = null;
        $attributes = AttributeResource::collection(Attribute::where('is_active', true)->whereNot('id', $attribute != null ? $attribute->id : 0)->latest()->get());
        return response()->json([
            'attributes' => $attributes,
            'attribute' => $attribute,
        ]);
    }

    public function toggle(int $slider_id, int $attribute_id)
    {
        $slider = null;
        if ($slider_id != 0)
            $slider = SliderSettings::whereId($slider_id)->update(['attribute_id' => $attribute_id]);
        else{
            $slider = SliderSettings::create([
                'attribute_id' => $attribute_id,
            ]);
            $slider_id = $slider->id;
        }
        $attribute = AttributeResource::make(SliderSettings::whereId($slider_id)->first()->attribute);
        $attributes = AttributeResource::collection(Attribute::where('is_active', true)->whereNot('id', $attribute_id)->latest()->get());
        return response()->json([
            'attributes' => $attributes,
            'attribute' => $attribute,
            'slider' => AdminSliderSettingResource::make($slider),
        ]);
    }
}
