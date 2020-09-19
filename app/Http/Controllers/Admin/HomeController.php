<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $pendingOrdersCount = Order::whereStatus('pending')->count();
        $returnedOrdersCount = Order::whereStatus('returned')->count();
        $inactiveProducts = Product::whereIsActive(0)->get();
        $outOfStockProducts = Product::whereShouldTrack(1)->where('stock_count', '<=', 0)->get();
        return view('admin.dashboard', compact('productsCount', 'ordersCount', 'pendingOrdersCount', 'returnedOrdersCount', 'inactiveProducts', 'outOfStockProducts'));
    }
}
