<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.reports.index', [
            'reports' => Report::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->has('code')) {
            if ($order = Order::find(request('code'))) {
                return $order;
            }
            return null;
        }

        return view('admin.reports.scanning');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'codes' => 'required',
            'orders' => 'required',
            'products' => 'required',
            'courier' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        Report::create($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $codes = explode(',', $report->codes);
        $codes = array_map('trim', $codes);
        $codes = array_filter($codes);

        return view('admin.reports.scanning', [
            'orders' => Order::whereIn('id', $codes)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'codes' => 'required',
            'orders' => 'required',
            'products' => 'required',
            'courier' => 'required',
            'status' => 'required',
            'total' => 'required',
        ]);

        $report->update($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        abort_unless(request()->user()->is('admin'), 403, 'Not Allowed.');
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    public function stock(Request $request)
    {
        return view('admin.reports.stock', [
            'products' => Product::whereShouldTrack(true)->orderBy('stock_count')->get(),
        ]);
    }

    public function customer(Request $request)
    {
        $_start = Carbon::parse(\request('start_d'));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');
        $type = $request->get('date_type', 'created_at');
        $top = $request->get('top_by', 'order_amount');

        $query = User::withWhereHas('orders', function ($query) use ($type, $_start, $_end) {
            $query->where('status', 'COMPLETED')
                ->whereBetween($type, [
                    $_start->startOfDay()->toDateTimeString(),
                    $_end->endOfDay()->toDateTimeString(),
                ]);
        });

        $users = $query->get()->map(function ($user) {
            $user->order_amount = $user->orders->sum('data.subtotal')
                + $user->orders->sum('data.shipping_cost')
                - $user->orders->sum('data.discount');
            $user->order_count = $user->orders->count();
            return $user;
        })->sortByDesc($top);

        return view('admin.reports.customer', [
            'users' => $users,
            'start' => $start,
            'end' => $end,
        ]);
    }
}
