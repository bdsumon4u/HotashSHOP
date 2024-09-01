<?php

use App\Http\Middleware\GoogleTagManagerMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

//Language Change
// Route::get('lang/{locale}', function ($locale) {
//     if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
//         abort(400);
//     }
//     Session::put('locale', $locale);
//     return redirect()->back();
// })->name('lang');

Route::middleware(GoogleTagManagerMiddleware::class)->group(function () {
    Route::get('auth', 'User\\Auth\\LoginController@showLoginForm')->middleware('guest:user')->name('auth');

    Route::get('/categories', 'ApiController@categories')->name('categories');
    Route::get('/brands', 'ApiController@brands')->name('brands');

    Route::get('/', 'HomeController')->name('/');
    Route::get('/distributors', 'HomeController@distributors')->name('distributors.index');
    Route::get('/sections/{section}/products', 'HomeSectionProductController')->name('home-sections.products');
    Route::get('/shop', 'ProductController@index')->name('products.index');
    Route::get('/products/{product:slug}', 'ProductController@show')->name('products.show');
    Route::get('/categories/{category:slug}/products', 'CategoryProductController')->name('categories.products');
    Route::get('/brands/{brand:slug}/products', 'BrandProductController')->name('brands.products');

    Route::view('/cart', 'cart')->name('cart');
    Route::match(['get', 'post'], '/checkout', 'CheckoutController')->name('checkout');
    Route::get('/thank-you', 'OrderTrackController')->name('thank-you');
    Route::match(['get', 'post'], 'track-order', 'OrderTrackController')->name('track-order');

    pageRoutes();
});

Route::get('/storage-link', 'ApiController@storageLink');
Route::get('/scout-flush', 'ApiController@scoutFlush');
Route::get('/scout-import', 'ApiController@scoutImport');
Route::get('/link-optimize', 'ApiController@linkOptimize');
Route::get('/cache-clear', 'ApiController@clearCache')->name('clear.cache');
