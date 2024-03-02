<?php

use App\Http\Middleware\GoogleTagManagerMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');

Route::middleware(GoogleTagManagerMiddleware::class)->group(function () {
    Route::get('auth', 'User\\Auth\\LoginController@showLoginForm')->middleware('guest:user')->name('auth');

    Route::get('/categories', function () {
        return view('categories', [
            'categories' => \App\Category::inRandomOrder()->get(),
        ]);
    })->name('categories');
    
    Route::get('/', 'HomeController')->name('/');
    Route::get('/sections/{section}/products', 'HomeSectionProductController')->name('home-sections.products');
    Route::get('/shop', 'ProductController@index')->name('products.index');
    Route::get('/products/{product:slug}', 'ProductController@show')->name('products.show');
    Route::get('/categories/{category:slug}/products', 'CategoryProductController')->name('categories.products');
    Route::get('/brands/{brand:slug}/products', 'BrandProductController')->name('brands.products');

    Route::view('/cart', 'cart')->name('cart');
    Route::match(['get', 'post'], '/checkout', 'CheckoutController')->name('checkout');
    Route::match(['get', 'post'], 'track-order', 'OrderTrackController')->name('track-order');

    pageRoutes();
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::get('/scout-flush', function () {
    Artisan::call('scout:flush', ["model" => "App\Product"]);
});

Route::get('/scout-import', function () {
    Artisan::call('scout:import', ["model" => "App\Product"]);
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return back()->with('success', 'Cache has been cleared');
})->name('clear.cache');
