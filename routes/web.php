<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Home\CallToAdmin\CallToAdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Models\AboutUsSetting;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::get('/درباره-' . AboutUsSetting::first()->store_name, function () {
    $info = AboutUsSetting::first();
    return Inertia::render('About-Us', ['info' => $info]);
})->name('about-us');

Route::controller(ProductController::class)->group(function () {
    Route::get('ProductShow/{id}', 'show')->name('ProductShow');
    Route::get('updateProductShow/{id}', 'getData')->name('getProductData');
    Route::get('/محصولات-جوانه-سبز', 'showAll')->name('products.showAll');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/ProductSearch/{input?}', 'search')->name('ProductSearch');
    Route::get('/searchPage', 'searchPage')->name('searchPage');
});

Route::controller(AddressController::class)->group(function () {
    Route::get('/cities/{city_id}', 'cities')->name('cities');
    Route::get('/getCities/{province_id}', 'getCities')->name('getCities');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/Categories', 'show')->name('categories.show');
});
Route::controller(BrandController::class)->group(function () {
    Route::get('/برندهای-محصولات-کشاورزی', 'show')->name('brands.show');
});

Route::post('TextToAdmin', [CallToAdminController::class, 'store'])->name('textToAdmin');
require __DIR__ . '/auth.php';
