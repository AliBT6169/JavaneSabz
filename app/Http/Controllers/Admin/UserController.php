<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $userData = User::latest()->paginate(10);
        return Inertia::render('Admin/pages/Users/index', ['userData' => $userData]);
    }
}
