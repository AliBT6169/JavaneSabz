<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Attribute\AttributeController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\ProductVariation\ProductVariationController;
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
        Route::get('/user', 'create')->name('users.create');
        Route::post('/user', 'store')->name('users.store');
        Route::get('/user/{id}', 'edit')->name('users.edit');
        Route::put('/user/', 'update')->name('users.update');
        Route::delete('/user/{id}', 'destroy')->name('users.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/index', 'index')->name('products.index');
        Route::get('/product/show', 'show')->name('products.show');
        Route::get('/product', 'create')->name('products.create');
        Route::post('/product', 'store')->name('products.store');
        Route::patch('/product/{id}', 'active_DeActive')->name('products.active_DeActive');
        Route::get('/product/{id}', 'edit')->name('products.edit');
        Route::put('/product', 'update')->name('products.update');
        Route::delete('/product/{id}', 'destroy')->name('products.destroy');
    });
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand/index', 'index')->name('brands.index');
        Route::get('/brand/show', 'show')->name('brands.show');
        Route::get('/brand', 'create')->name('brands.create');
        Route::post('/brand', 'store')->name('brands.store');
        Route::patch('/brand/{id}', 'toggle')->name('brands.toggle');
        Route::get('/brand/{id}', 'edit')->name('brands.edit');
        Route::put('/brand', 'update')->name('brands.update');
        Route::delete('/brand/{id}', 'destroy')->name('brands.destroy');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/index', 'index')->name('categories.index');
        Route::get('/category/show', 'show')->name('categories.show');
        Route::get('/category', 'create')->name('categories.create');
        Route::post('/category', 'store')->name('categories.store');
        Route::patch('/category/{id}', 'toggle')->name('categories.toggle');
        Route::get('/category/{id}', 'edit')->name('categories.edit');
        Route::put('/category', 'update')->name('categories.update');
        Route::delete('/category/{id}', 'destroy')->name('categories.destroy');
    });
    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attribute/index', 'index')->name('attributes.index');
        Route::get('/attribute', 'create')->name('attributes.create');
        Route::post('/attribute', 'store')->name('attributes.store');
        Route::patch('/attribute/{id}', 'toggle')->name('attributes.toggle');
        Route::get('/attribute/{id}', 'edit')->name('attributes.edit');
        Route::put('/attribute', 'update')->name('attributes.update');
        Route::delete('/attribute/{id}', 'destroy')->name('attributes.destroy');
    });
    Route::resource('orders', OrderController::class)->except('update');
    Route::controller(OrderController::class)->group(function () {
        Route::put('/orders/update', 'update')->name('orders.update');
        Route::post('/orders/getProducts', 'getProducts')->name('orders.getProducts');
        Route::patch('/orders/{id}/disable', 'disable')->name('orders.disable');
    });
    Route::controller(ProductVariationController::class)->group(function () {
        Route::get('/productVariation/show', 'show')->name('productVariations.show');
    });
});


