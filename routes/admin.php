<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(AdminMiddleware::class)->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/AdminDashboard', 'index')->name('AdminDashboard');
    });

    Route::get('/user/index', function () {
        return Inertia::render('Admin/pages/Users/index');
    })->name('users.index');
});


