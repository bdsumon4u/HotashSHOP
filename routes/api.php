<?php

use App\Order;
use App\Pathao\Facade\Pathao;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fix-orders-products', function () {
    $orders = Order::all()->mapWithKeys(function ($order) {
        return [$order->id => collect(json_decode(json_encode($order->products), true))->keyBy('id')->toJson()];
    });

    DB::statement('UPDATE orders SET products = CASE id ' . $orders->map(function ($products, $id) {
        return "WHEN $id THEN '$products'";
    })->implode(' ') . ' END');
});

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::get('products', 'ProductController')->name('products');
    Route::get('images', 'ImageController@index')->name('images.index');
    Route::get('images/single', 'ImageController@single')->name('images.single');
    Route::get('images/multiple', 'ImageController@multiple')->name('images.multiple');
    Route::post('menu/{menu}/sort-items', 'MenuItemSortController')->name('menu-items.sort');
    Route::get('orders', 'OrderController')->name('orders');

    Route::get('areas/{city_id}', function ($city_id) {
        return Pathao::area()->zone($city_id)->data;
    });
});

Route::get('/categories', function () {
    return response()->json(\App\Category::all()->toArray());
});

Route::get('/products/{search}', function ($search) {
    $products = Product::where('name', 'like', "%$search%")->take(5)->get();

    return view('admin.orders.searched', compact('products'))->render();
});

Route::get('pending-count/{admin}', function (\App\Admin $admin) {
    return \App\Order::where('status', 'PENDING')->when($admin->role_id == \App\Admin::SALESMAN, function ($query) use (&$admin) {
        $query->where('admin_id', $admin->id);
    })->count();
});

Route::get('/pathao-webhook', function (Request $request) {
    $Pathao = setting('Pathao');
    if ($request->header('X-PATHAO-Signature') != $Pathao->store_id) {
        return;
    }

    if (! $order = Order::find($request->merchant_order_id)/*->orWhere('data->consignment_id', $request->consignment_id)*/->first()) return;

    // $courier = $request->only([
    //     'consignment_id',
    //     'order_status',
    //     'reason',
    //     'invoice_id',
    //     'payment_status',
    //     'collected_amount',
    // ]);
    // $order->forceFill(['courier' => ['booking' => 'Pathao'] + $courier]);

    if ($request->order_status_slug == 'Pickup_Cancelled') {
        $order->status = 'CANCELLED';
        $order->status_at = now();
    }
    if ($request->order_status_slug == 'On_Hold') {
        $order->status = 'WAITING';
        $order->status_at = now();
    }
    if ($request->order_status_slug == 'Delivered') {
        $order->status = 'COMPLETED';
        $order->status_at = now();
    }
    if ($request->order_status_slug == 'Payment_Invoice') {
        
    }
    if ($request->order_status_slug == 'Return') {
        $order->status = 'RETURNED';
        $order->status_at = now();
        // TODO: add to stock
    }

    $order->save();
});
