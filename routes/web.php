<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');

Route::view('auth', 'auth')->middleware('guest:user')->name('auth');

Route::get('/', 'HomeController')->name('/');
Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{product:slug}', 'ProductController@show')->name('products.show');
Route::get('/categories/{category:slug}/products', 'CategoryProductController')->name('categories.products');
Route::get('/brands/{brand:slug}/products', 'BrandProductController')->name('brands.products');

Route::view('/cart', 'cart')->name('cart');
Route::match(['get', 'post'], '/checkout', 'CheckoutController')->name('checkout');
Route::get('track-order', 'OrderTrackController')->name('track-order');

pageRoutes();

Route::get('/storage-link', function() {
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');
