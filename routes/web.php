<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\WishListController;
use App\Models\ProductVariation;
use App\Models\Wishlist;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $indexData = (object)[
        "products"=> ProductVariation::getSomeProduct(20),
    ];
    return Inertia::render('Index', ["indexData" => $indexData]);
});

Route::get('/درباره ما', function () {
    return Inertia::render('About-Us');
});


Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/show', 'show')->name('profile.show');
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::controller(WishListController::class)->group(function () {
        Route::delete('/wishlist/delete/{product_id}/{user_id}', 'destroy')->name('wishlist.destroy');
    });
});

require __DIR__ . '/auth.php';
