<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NotificationResource;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notifications = NotificationResource::collection($this->notificationService->getWithPagination(10));
        return Inertia::render('Admin/pages/Notifications/index', ['notifications' => $notifications]);
    }

    public function create(Request $request)
    {
        $this->notificationService->createNotification([
            'title' => $request->title,
            'body' => $request->body
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getUnseens()
    {
        return NotificationResource::collection($this->notificationService->getUnseensCount());
    }

    public function seen(Request $request)
    {
        $data = array();
        foreach ($request->all() as $value) {
            $data[] = $value;
        }
        $seen = $this->notificationService->getSeen($data);
        return response()->json([
            'status' => 200,
            'unSeen' => $seen
        ]);
    }

}
