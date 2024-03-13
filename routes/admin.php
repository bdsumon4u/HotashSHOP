<?php

use Illuminate\Support\Facades\Route;
use Hotash\LaravelMultiUi\Facades\MultiUi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        Route::get('/reports/stock', 'ReportController@stock')->name('reports.stock');
        Route::get('/reports/filter', 'OrderController@filter')->name('orders.filter');
        Route::get('/reports/customer', 'ReportController@customer')->name('reports.customer');
        Route::get('/orders/invoices', 'OrderController@invoices')->name('orders.invoices');
        Route::get('/orders/booking', 'OrderController@booking')->name('orders.booking');
        Route::post('/orders/change-courier', 'OrderController@courier')->name('orders.courier');
        Route::post('/orders/change-status', 'OrderController@status')->name('orders.status');
        Route::patch('/orders/{order}/update-quantity', 'OrderController@updateQuantity')->name('orders.update-quantity');
        Route::post('/logout-others/{admin}', function (\App\Admin $admin) {
            if (Hash::check(request()->get('password'), $admin->password)) {
                $authUser = Auth::guard('admin')->user();
                Auth::guard('admin')->setUser($admin)->logoutOtherDevices(request()->get('password'));

                if (!$admin->is($authUser)) {
                    DB::table('sessions')
                        ->where('userable_type', \App\Admin::class)
                        ->where('userable_id', $admin->id)
                        ->delete();
                }

                Auth::guard('admin')->setUser($authUser);

                return redirect()->back()->with('success', 'Logged Out From Other Devices');
            }

            return redirect()->back()->withErrors(['password' => 'Password is incorrect']);
        })->name('logout-others');
        Route::get('/customers', 'CustomerController')->name('customers');
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
