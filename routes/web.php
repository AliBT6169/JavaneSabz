<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\User\Dashboard\WishListController;
use App\Http\Controllers\User\UserController;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $indexData = (object)[
        "products" => ProductVariation::getSomeProduct(20),
    ];
    return Inertia::render('Index', ["indexData" => $indexData]);
});

Route::get('/درباره ما', function () {
    return Inertia::render('About-Us');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('ProductShow/{id}', 'show')->name('ProductShow');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/ProductSearch/{input?}', 'search')->name('ProductSearch');
    Route::get('/searchPage', 'searchPage')->name('searchPage');
});

require __DIR__ . '/auth.php';
