<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
        "products" => ProductVariation::getSomeProduct(20)
    ];
    return Inertia::render('Index', ["indexData" => $indexData]);
});

Route::get('/درباره ما', function () {
    return Inertia::render('About-Us');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('ProductShow/{id}', 'show')->name('ProductShow');
    Route::get('updateProductShow/{id}', 'getData')->name('getProductData');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/ProductSearch/{input?}', 'search')->name('ProductSearch');
    Route::get('/searchPage', 'searchPage')->name('searchPage');
});

Route::controller(AddressController::class)->group(function () {
    Route::get('/cities/{province_id}', 'cities')->name('cities');
    Route::get('/provinces', 'provinces')->name('provinces');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'show')->name('categories.show');
});
Route::controller(BrandController::class)->group(function () {
    Route::get('/brands', 'show')->name('brands.show');
});
require __DIR__ . '/auth.php';
