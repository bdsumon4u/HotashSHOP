<?php

use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;

# Controller Level Namespace
Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function() {

    # Admin Level Namespace & No Prefix
    MultiUi::routes([
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

    Route::group(['prefix' => 'admin'], function() {
        # Admin Level Namespace & 'admin' Prefix
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('example', function() {
            dump('bdsumon4u');
        })->name('example');
        #...
        #...
    });
});

# Controller Level Namespace & No Prefix
#...
#...