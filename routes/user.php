<?php

use App\Http\Middleware\GoogleTagManagerMiddleware;
use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;

# Controller Level Namespace
Route::group(['namespace' => 'User', 'as' => 'user.', 'middleware' => GoogleTagManagerMiddleware::class], function() {

    # User Level Namespace & No Prefix
    MultiUi::routes([
        'URLs' => [
            'login' => 'enter',
            'register' => 'create-user-account',
            'reset/password' => 'reset-pass',
            'logout' => 'getout',
        ],
        'prefix' => [
            'URL' => 'user-',
            'except' => 'register',
        ],
    ]);
    #...
    #...

    Route::group(['prefix' => 'user'], function() {
        # User Level Namespace & 'user' Prefix
        Route::post('resend-otp', 'Auth\LoginController@resendOTP')->name('resend-otp');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::match(['get', 'post'], '/change-password', 'Auth\\ChangePasswordController')
            ->name('password.change');
        Route::match(['get', 'post'], '/edit-profile', 'ProfileController')
            ->name('profile.edit');
        #...
        Route::middleware('auth:user')->group(function () {
            Route::get('/orders', 'OrderController')->name('orders');
        });
        #...
    });
});

# Controller Level Namespace & No Prefix
#...
#...
