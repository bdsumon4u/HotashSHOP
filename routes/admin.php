<?php

use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;

# Controller Level Namespace
Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function() {

    # Admin Level Namespace & No Prefix
    MultiUi::routes([
        'register' => false,
        'URLs' => [
            'login' => 'enter',
            'register' => 'create-admin-account',
            'reset/password' => 'reset-pass',
            'logout' => 'getout',
        ],
        'prefix' => [
            'URL' => 'admin-',
            'except' => 'register',
        ],
    ]);
    #...
    #...
    
    Route::redirect('/admin', '/admin/dashboard', 301); # Permanent Redirect
    Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function() {
        # Admin Level Namespace & 'admin' Prefix
        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::match(['get', 'post'], '/change-password', 'Auth\\ChangePasswordController')
            ->name('password.change');
        Route::any('settings', 'SettingController')->name('settings');
        Route::resources([
            'slides'        => 'SlideController',
            'categories'    => 'CategoryController',
            'brands'        => 'BrandController',
            'products'      => 'ProductController',
            'images'        => 'ImageController',
            'orders'        => 'OrderController',
            'home-sections' => 'HomeSectionController',
            'pages'         => 'PageController',
            'menus'         => 'MenuController',
            'menu-items'    => 'MenuItemController',
        ]);
    });
});

# Controller Level Namespace & No Prefix
#...
#...