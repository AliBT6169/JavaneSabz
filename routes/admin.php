<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Brand\BrandController;
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
        Route::post('/product', 'store')->name('products.store');
        Route::patch('/product/{id}', 'active_DeActive')->name('products.active_DeActive');
        Route::get('/product/{id}', 'edit')->name('products.edit');
        Route::put('/product', 'update')->name('products.update');
        Route::delete('/product/{id}', 'destroy')->name('products.destroy');
    });
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand/index', 'index')->name('brands.index');
        Route::get('/brand/create', 'create')->name('brands.create');
        Route::post('/brand', 'store')->name('brands.store');
        Route::patch('/brand/{id}', 'toggle')->name('brands.toggle');
        Route::get('/brand/{id}', 'edit')->name('brands.edit');
        Route::put('/brand', 'update')->name('brands.update');
        Route::delete('/brand/{id}', 'destroy')->name('brands.destroy');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/index', 'index')->name('categories.index');
    });
});


