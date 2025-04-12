<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shimadotdev\IranRegions\Models\Province;

class AddressController extends Controller
{
    public function cities()
    {

    }

    public function provinces()
    {
        $result = [];
        $data = Province::all();
        foreach ($data as $province) {
            $result[] = [
                'id' => $province->id,
                'name' => trans('iranRegions::slug.' . $province->slug),
            ];
        }
        return $result;
    }
}
