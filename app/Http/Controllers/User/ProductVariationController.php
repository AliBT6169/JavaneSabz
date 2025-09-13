<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProductRateStoreRequest;
use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariationController extends Controller
{

    protected $rateService;

    public function __construct(RateService $rate)
    {
        $this->rateService = $rate;
    }


    public function getRate(ProductRateStoreRequest $request)
    {
        $data = array([
            'rate' => $request->rate,
            'user_id' => Auth::id(),
            'rateable_id' => $request->id,
            'rateable_type' => 'App\Models\ProductVariation',
        ]);
        $this->rate->create($data);
        $ratesAverage = Rate::where('rateable_id', $request->id)->average('rate');
        return response([
            'rate' => $ratesAverage,
            'status' => 200,
        ]);
    }
}
