<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return DataTables::of(Order::all())
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-M-Y');
            })
            ->addColumn('contacts', function ($row) {
                return "<div>
                    <span>{$row->phone}</span>
                    <br />
                    <span>{$row->email}</span>
                </div>";
            })
            ->addColumn('actions', function (Order $order) {
                return '<div>
                    <a href="'.route('admin.orders.show', $order).'" class="btn btn-sm btn-primary px-2 d-block">View</a>
                    <a href="'.route('admin.orders.destroy', $order).'" data-action="delete" class="btn btn-sm btn-danger px-2 d-block">Delete</a>
                </div>';
            })
            ->rawColumns(['created_at', 'contacts', 'actions'])
            ->make(true);
    }
}
