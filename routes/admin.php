<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Attribute\AttributeController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Blog\AdminBlogController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Comments\AdminCommentController;
use App\Http\Controllers\Admin\Delivery\DeliveryController;
use App\Http\Controllers\Admin\NavSettingController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\ProductVariation\ProductVariationController;
use App\Http\Controllers\Admin\Setting\AboutUsSettingController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\SliderSettingController;
use App\Http\Controllers\Admin\Transaction\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserMail\AdminUserMailController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/AdminDashboard', 'index')->name('AdminDashboard');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/index', 'index')->name('users.index');
        Route::get('/user/showAll', 'showAll')->name('users.showAll');
        Route::get('/user', 'create')->name('users.create');
        Route::post('/user', 'store')->name('users.store');
        Route::get('/user/{id}', 'edit')->name('users.edit');
        Route::put('/user/', 'update')->name('users.update');
        Route::delete('/user/{id}', 'destroy')->name('users.destroy');
        Route::get('/user/search/{name}', 'search')->name('users.search');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/index', 'index')->name('products.index');
        Route::get('/product/show', 'show')->name('products.show');
        Route::get('/product', 'create')->name('products.create');
        Route::post('/product', 'store')->name('products.store');
        Route::get('/product/search/{name}', 'search')->name('products.search');
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
        Route::Patch('/brand/bestBrandToggle/{id}', 'toggleToBest')->name('brands.bestBrandToggle');
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
        Route::get('/productVariation/increment/{id}', 'Increment')->name('productVariation.Increment');
        Route::get('/productVariation/decrement/{id}', 'Decrement')->name('productVariation.Decrement');
    });
    Route::get('/deliveries/GetCityName/{city_id}', [DeliveryController::class, 'GetCityName'])->name('deliveries.GetCityName');
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaction/index', 'index')->name('transactions.index');
    });
    Route::controller(AdminCommentController::class)->group(function () {
        Route::get('/comment/index', 'index')->name('comments.index');
        Route::get('/comment/create', 'create')->name('comments.create');
        Route::patch('/comment/change_status', 'change_status')->name('comments.change_status');
        Route::get('/comment/search/{text}', 'search')->name('comments.search');
    });
    Route::controller(AdminUserMailController::class)->group(function () {
        Route::get('/getUsersNotSeenMails', 'getUsersNotSeenMails')->name('getUsersNotSeenMails');
        Route::get('/seenAllMails', 'seenAllMails')->name('seenAllMails');
        Route::get('/UserMailsIndex', 'index')->name('userMails.index');
    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting/index', 'index')->name('settings.index');
        Route::put('/setting/update', 'update')->name('settings.update');
    });
    Route::controller(AboutUsSettingController::class)->group(function () {
        Route::put('/aboutUsSetting/update', 'update')->name('aboutUsSetting.update');
    });
    Route::controller(NavSettingController::class)->group(function () {
        Route::put('/navSetting/attributeSet', 'setAttributeToNavItem')->name('navSetting.AttributeSet');
        Route::get('/navSetting/getAttributes/{id}', 'geAttributes')->name('navSetting.getAttributes');
        Route::patch('/navSetting/queueToggle', 'queueToggle')->name('navSetting.queueToggle');
        Route::patch('/navSetting/toggle/{id}', 'toggle')->name('navSetting.toggle');
    });
    Route::controller(AdminBlogController::class)->group(function () {
        Route::get('/blog/index', 'index')->name('blogs.index');
        Route::get('/blog/create', 'create')->name('blogs.create');
        Route::post('/blog/store', 'store')->name('blogs.store');
        Route::get('/blog/{id}', 'edit')->name('blogs.edit');
        Route::post('/blog/update', 'update')->name('blogs.update');
        Route::delete('/blog/destroy/{id}', 'destroy')->name('blogs.destroy');
    });

    Route::controller(BannerController::class)->group(function () {
       Route::get('/banner/getAttribute/{id}', 'getAttribute')->name('banner.getAttribute');
       Route::patch('/banner/attributeToggle/{banner_id}/{attribute_id}', 'toggle')->name('banner.attributeToggle');
    });

    Route::controller(SliderSettingController::class)->group(function () {
       Route::get('/slider/getAttribute/{id}', 'getAttribute')->name('slider.getAttribute');
       Route::patch('/slider/attributeToggle/{slider_id}/{attribute_id}', 'toggle')->name('slider.attributeToggle');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification/index', 'index')->name('notifications.index');
        Route::post('/notification/seen', 'seen')->name('notifications.seen');
    });
});


