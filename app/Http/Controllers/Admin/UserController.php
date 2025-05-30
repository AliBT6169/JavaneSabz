<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $userData = UserResource::collection(User::latest()->paginate(10));
        return Inertia::render('Admin/pages/Users/index', ['userData' => $userData]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return [
            'status' => 200,
            'message' => 'User deleted'
        ];
    }

    public function edit($id)
    {
        $user = UserResource::make(User::whereId($id)->first());
        return Inertia::render('Admin/pages/Users/edit', ['user' => $user]);
    }

    public function update(UserRequest $request)
    {
        return $request;
    }
}
