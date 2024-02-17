<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $_start = Carbon::parse(\request('start_d'));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');

        $totalSQL = 'COUNT(*) as order_count, COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.subtotal"))) + SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.shipping_cost"))) - SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.discount"))), 0) as total_amount';

        $orderQ = Order::query()->whereBetween(request('date_type', 'created_at'), [$_start->startOfDay()->toDateTimeString(), $_end->endOfDay()->toDateTimeString()]);
        $data = (clone $orderQ)
            ->selectRaw($totalSQL)
            ->first();
        $orders['Total'] = $data->order_count;
        $amounts['Total'] = $data->total_amount;
        foreach (config('app.orders', []) as $status) {
            $data = (clone $orderQ)->where('status', $status)
                ->selectRaw($totalSQL)
                ->first();
            $orders[$status] = $data->order_count ?? 0;
            $amounts[$status] = $data->total_amount ?? 0;
        }

        $productsCount = Product::whereNull('parent_id')->count();
        $inactiveProducts = Product::whereIsActive(0)->whereNull('parent_id')->get();
        $outOfStockProducts = Product::whereShouldTrack(1)->where('stock_count', '<=', 0)->get();
        return view('admin.dashboard', compact('productsCount', 'orders', 'amounts', 'inactiveProducts', 'outOfStockProducts', 'start', 'end'));
    }
}
