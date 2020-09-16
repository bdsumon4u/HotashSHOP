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

Route::get('/', 'HomeController')->name('/');
Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{product:slug}', 'ProductController@show')->name('products.show');
Route::get('/categories/{category:slug}/products', 'CategoryProductController')->name('categories.products');
Route::get('/brands/{brand:slug}/products', 'BrandProductController')->name('brands.products');
Route::view('/cart', 'cart')->name('cart');
Route::view('/checkout', 'checkout')->name('checkout');
Route::post('post-checkout', 'CheckoutController')->name('post-checkout');
Route::get('post-checkout/phone/{phone}/order/{order}', 'CheckoutController@done')->name('checkout.done');

Route::prefix('dashboard')->group(function () {
    Route::view('index', 'dashboard.index')->name('index');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::resources([
        'slides'        => 'SlideController',
        'categories'    => 'CategoryController',
        'brands'        => 'BrandController',
        'products'      => 'ProductController',
        'images'        => 'ImageController',
        'home-sections' => 'HomeSectionController',
        'pages'         => 'PageController',
        'menus'         => 'MenuController',
        'menu-items'    => 'MenuItemController',
    ]);
});

pageRoutes();

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');
