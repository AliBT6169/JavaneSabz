<?php

namespace App\Http\Controllers\Home\CallToAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CallToAdmin\CallToAdminStoreRequest;
use App\Models\CallToAdmin;
use Illuminate\Http\Request;

class CallToAdminController extends Controller
{
    public function store(CallToAdminStoreRequest $request)
    {
        CallToAdmin::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'text' => $request['text'],
        ]);
        return response()->json('پیام شما به مدیریت ارسال شد.', 200);
    }
}
