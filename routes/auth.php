<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\Dashboard\BuyCartController;
use App\Http\Controllers\User\Dashboard\DashboardController;
use App\Http\Controllers\User\Dashboard\WishListController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');

    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/show', 'show')->name('profile.show');
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::controller(WishListController::class)->group(function () {
        Route::delete('/wishlist/delete/{product_id}/{user_id}', 'destroy')->name('wishlist.destroy');
        Route::post('/wishlist/{product_id}/{user_id}', 'store')->name('wishlist.store');
    });
    Route::controller(UserController::class)->group(function () {
        Route::post('/user/update', 'store')->name('user.update');
    });
    Route::controller(BuyCartController::class)->group(function () {
        Route::post('/IncrementBuyCart/{id}', 'CartItemIncrement')->name('BuyCart.CartItemIncrement');
        Route::post('/DecrementBuyCart/{id}', 'CartItemDecrement')->name('BuyCart.CartItemDecrement');
        Route::post('/addToBuyCart/{product_id}', 'addToBuyCart')->name('BuyCart.adToBuyCart');
        Route::delete('/deleteItemFromCart/{product_id}', 'deleteItemFromCart')->name('BuyCart.deleteItemFromCart');
//        Complete User Cart & Make Order
        Route::get('/completePayment', 'completeCart')->name('BuyCart.completePayment');
        //checks a coupon code
    });
    Route::controller(CouponController::class)->group(function () {
        Route::post('Coupon-Checker', 'CouponChecker')->name('CouponChecker');
    });
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/Payment/{order_id}', 'paymentPage')->name('paymentPage');
    });
    Route::controller(CommentController::class)->group(function () {
        Route::post('/Comment/store', 'store')->name('Comment.store');
    });
});

