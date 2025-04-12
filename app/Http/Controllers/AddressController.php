<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function cities($province_id)
    {
        $data = City::where('province_id', $province_id)->get();
        $result = [];
        foreach ($data as $city) {
            $result[] = [
                'id' => $city->id,
                'name' => $city->slug,
            ];
        }
        return $result;
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
