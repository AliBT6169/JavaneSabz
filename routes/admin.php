<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(AdminMiddleware::class)->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/AdminDashboard', 'index')->name('AdminDashboard');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/index', 'index')->name('users.index');
    });
});


