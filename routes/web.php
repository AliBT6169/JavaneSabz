<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Home\CallToAdmin\CallToAdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Models\AboutUsSetting;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/وبلاگ', 'blogs')->name('blogs');
    Route::get('/وبلاگ/' . '{id}-' . '{slug}', 'blogShow')->name('blogs.show');
});

Route::get('/درباره-جوانه سبز' , function () {
    $info = AboutUsSetting::first();
    return Inertia::render('About-Us', ['info' => $info]);
})->name('about-us');

Route::controller(ProductController::class)->group(function () {
    Route::get('/محصول/' . '{id}-' . '{slug}', 'show')->name('ProductShow');
    Route::get('/محصولات/', 'showAll')->name('AllProductsShow');
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
    Route::get('/دسته-بندی-محصولات-کشاورزی', 'show')->name('categories.show');
    Route::get('/دسته-بندی/' . '{id}-' . '{slug}', 'productShow')->name('categories.products.show');
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/برندهای-محصولات-کشاورزی', 'show')->name('brands.show');
    Route::get('/برند/' . '{id}-' . '{slug}', 'productsShow')->name('brands.products.show');
});

Route::controller(AttributeController::class)->group(function () {
    Route::get('/attribute/' . '{id}-' . '{slug}', 'sendToShow')->name('attributes.sendToShow');
    Route::get('/{name}/' . '{id}-' . '{slug}', 'show')->name('attributes.show');
});

Route::get('/حریم-خصوصی-و-امنیت', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('/شرایط-و-خدمات', function () {
    return Inertia::render('TermsConditions');
})->name('terms-conditions');

Route::prefix('pay/')->name('pay.')->controller(PaymentController::class)->group(function () {
    Route::get('/Zibal', 'ZibalCallBack')->name('ZibalCallBack');
});

Route::post('TextToAdmin', [CallToAdminController::class, 'store'])->name('textToAdmin');
require __DIR__ . '/auth.php';
