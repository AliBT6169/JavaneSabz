<?php

namespace App\Http\Controllers\Admin\UserMail;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CallToAdminIndexResource;
use App\Models\CallToAdmin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserMailController extends Controller
{
    public function index()
    {
        $data = CallToAdminIndexResource::collection(CallToAdmin::latest()->paginate(10));
        return Inertia::render('Admin/pages/UserMails/index', ['mails' => $data]);
    }

    public function getUsersNotSeenMails()
    {
        $data = CallToAdminIndexResource::collection(CallToAdmin::where('seen', 0)->latest()->get());
        return response()->json($data);
    }

    public function seenAllMails()
    {
        CallToAdmin::where('seen', 0)->update(['seen' => 1]);
        return response()->json('success');
    }
}
