<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentSepController extends Controller
{
    public function SepIndex()
    {
        return response()->noContent();
    }
}
