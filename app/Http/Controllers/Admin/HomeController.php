<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $initialStatus = data_get(config('app.orders'), 0, 'PENDING');
        $initialOrdersCount = Order::whereStatus($initialStatus)->count();
        $returnedOrdersCount = Order::whereStatus('returned')->count();
        $inactiveProducts = Product::whereIsActive(0)->get();
        $outOfStockProducts = Product::whereShouldTrack(1)->where('stock_count', '<=', 0)->get();
        return view('admin.dashboard', compact('productsCount', 'ordersCount', 'initialStatus', 'initialOrdersCount', 'returnedOrdersCount', 'inactiveProducts', 'outOfStockProducts'));
    }
}
