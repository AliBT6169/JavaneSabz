<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create(Request $request)
    {
        NotificationService::class->create($request);
    }
}
