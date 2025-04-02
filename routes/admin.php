<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/user/index', function () {
        return Inertia::render('Admin/pages/Users/index');
    })->name('admin.users.index');
});


