<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function cities($city_id = 126)
    {
        $city = City::whereId($city_id)->first();
        $province = $city->province;
        $cities = $province->cities;
        $provinces = Province::all();
        return response()->json([
            'cities' => $cities,
            'provinces' => $provinces,
            'province' => $province,
            'city' => $city,
        ]);
    }

    public function getCities($province_id)
    {
        $province = Province::whereId($province_id)->first();
        $cities = $province->cities;
        return $cities;
    }
}
