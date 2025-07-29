<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function cities($city_id)
    {
        $city = City::whereId($city_id);
        $province =  $city->province;
        $cities = $province->cities;

    }

    public function provinces()
    {
        $result = [];
        $data = Province::all();
        foreach ($data as $province) {
            $result[] = [
                'id' => $province->id,
                'name' => $province->slug,
            ];
        }
        return $result;
    }
}
