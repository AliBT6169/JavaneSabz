<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function GetCityName(string $id)
    {
        $city = City::whereId($id)->first();
        return response()->json([
            'city' => $city->name,
            'province' => $city->province->name,
        ]);
    }
}
