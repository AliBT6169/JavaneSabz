<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(AdminMiddleware::class)->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/AdminDashboard', 'index')->name('AdminDashboard');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/index', 'index')->name('users.index');
        Route::get('/user', 'create')->name('users.create');
        Route::post('/user', 'store')->name('users.store');
        Route::get('/user/{id}', 'edit')->name('users.edit');
        Route::put('/user/', 'update')->name('users.update');
        Route::delete('/user/{id}', 'destroy')->name('users.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/index', 'index')->name('products.index');
        Route::get('/product', 'create')->name('products.create');
    });
});


