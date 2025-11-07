<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SMSResource;
use App\Models\User;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SMSController extends Controller
{
    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function index(): Response
    {
        return Inertia::render('Admin/pages/SMS/index', ['messages' => SMSResource::collection($this->smsService->index())]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/pages/SMS/create');
    }

    public function store(Request $request)
    {
        $message = $request->message;
        $status = $this->smsService->store(User::pluck('cellphone')->toArray(), $message);
        if ($status)
            return response()->noContent();
        abort(500, 'عملیات با مشکل مواجه شد!');
    }
}
