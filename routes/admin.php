<?php

use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;

# Controller Level Namespace
Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {

    # Admin Level Namespace & No Prefix
    MultiUi::routes([
        'register' => false,
        'URLs' => [
            'login' => 'getpass',
            'register' => 'create-admin-account',
            'reset/password' => 'reset-pass',
            'logout' => 'getout',
        ],
        'prefix' => [
            'URL' => 'admin-',
            'except' => ['login', 'register'],
        ],
    ]);
    #...
    #...

    Route::redirect('/admin', '/admin/dashboard', 301); # Permanent Redirect
    Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
        # Admin Level Namespace & 'admin' Prefix
        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::match(['get', 'post'], '/profile', 'Auth\\ChangePasswordController')
            ->name('password.change');
        Route::any('settings', 'SettingController')->name('settings');
        Route::get('/reports/filter', 'OrderController@filter')->name('orders.filter');
        Route::get('/orders/invoices', 'OrderController@invoices')->name('orders.invoices');
        Route::get('/orders/courier', 'OrderController@courier')->name('orders.courier');
        Route::post('/orders/change-status', 'OrderController@status')->name('orders.status');
        Route::patch('/orders/{order}/add-product', 'OrderController@addProduct')->name('orders.add-product');
        Route::patch('/orders/{order}/update-quantity', 'OrderController@updateQuantity')->name('orders.update-quantity');
        Route::resources([
            'staffs'       => 'StaffController',
            'slides'        => 'SlideController',
            'categories'    => 'CategoryController',
            'brands'        => 'BrandController',
            'attributes.options' => 'AttributeOptionController',
            'attributes' => 'AttributeController',
            'products.variations' => 'ProductVariationController',
            'products'      => 'ProductController',
            'images'        => 'ImageController',
            'orders'        => 'OrderController',
            'reports'      => 'ReportController',
            'home-sections' => 'HomeSectionController',
            'pages'         => 'PageController',
            'menus'         => 'MenuController',
            'menu-items'    => 'MenuItemController',
            'category-menus' => 'CategoryMenuController',
        ]);
    });
});

# Controller Level Namespace & No Prefix
#...
#...
