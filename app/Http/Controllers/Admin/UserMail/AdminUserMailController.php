<?php

namespace App\Http\Controllers\Admin\UserMail;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CallToAdminIndexResource;
use App\Models\CallToAdmin;
use Illuminate\Http\Request;

class AdminUserMailController extends Controller
{
    public function getUsersNotSeenMails()
    {
        $data = CallToAdminIndexResource::collection(CallToAdmin::where('seen', 0)->latest()->get());
        return response()->json($data);
    }
}
