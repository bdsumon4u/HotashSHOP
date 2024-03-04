<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $totalSQL = 'COUNT(*) as order_count, SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.subtotal"))) + SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.shipping_cost"))) - COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.discount"))), 0) as total_amount';

        $orderQ = Order::query()
            ->whereBetween(request('date_type', 'created_at'), [
                $_start->startOfDay()->toDateTimeString(),
                $_end->endOfDay()->toDateTimeString(),
            ]);

        if (request('staff_id')) {
            $orderQ->where('admin_id', request('staff_id'));
        }

        $products = (clone $orderQ)->get()
            ->when(request('status'), fn ($query) => $query->where('status', request('status')))
            ->flatMap(fn ($order) => json_decode(json_encode($order->products), true))
            ->groupBy('name')->map(function ($item) {
                return [
                    'quantity' => $item->sum('quantity'),
                    'total' => $item->sum('total'),
                ];
            })->toArray();

        $data = (clone $orderQ)
            ->selectRaw($totalSQL)
            ->first();
        $orders['Total'] = $data->order_count;
        $amounts['Total'] = $data->total_amount;

        $data = (clone $orderQ)->where('type', Order::ONLINE)
            ->selectRaw($totalSQL)
            ->first();
        $orders['Online'] = $data->order_count;
        $amounts['Online'] = $data->total_amount;

        $data = (clone $orderQ)->where('type', Order::MANUAL)
            ->selectRaw($totalSQL)
            ->first();
        $orders['Manual'] = $data->order_count;
        $amounts['Manual'] = $data->total_amount;

        foreach (config('app.orders', []) as $status) {
            $data = (clone $orderQ)->where('status', $status)
                ->selectRaw($totalSQL)
                ->first();
            $orders[$status] = $data->order_count ?? 0;
            $amounts[$status] = $data->total_amount ?? 0;
        }

        $query = DB::table('admins')->leftJoin('sessions', 'userable_id', 'admins.id')->where('userable_type', Admin::class);
        $online = $query->where('last_activity', '>=', now()->subMinutes(5)->timestamp)->groupBy('admins.email')->get();
        $offline = DB::table('admins')->whereNotIn('email', $online->pluck('email'))->get();
        $staffs = compact('online', 'offline');

        $productsCount = Product::whereNull('parent_id')->count();
        $inactiveProducts = Product::whereIsActive(0)->whereNull('parent_id')->get();
        $lowStockProducts = Product::whereShouldTrack(1)->where('stock_count', '<', 10)->get();
        return view('admin.dashboard', compact('staffs', 'products', 'productsCount', 'orders', 'amounts', 'inactiveProducts', 'lowStockProducts', 'start', 'end'));
    }
}
