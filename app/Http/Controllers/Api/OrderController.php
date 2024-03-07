<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
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
        $_start = Carbon::parse(\request('start_d'));
        $_end = Carbon::parse(\request('end_d'));

        $orders = Order::with('admin');
        if (strtolower($request->type) == 'online') {
            $orders->where('type', Order::ONLINE);
        } elseif (strtolower($request->type) == 'manual') {
            $orders->where('type', Order::MANUAL);
        }

        if ($request->user_id) {
            $orders->where('user_id', $request->user_id);
        }

        if ($request->status) {
            $orders->where('status', $request->status);
        }

        if ($request->staff_id) {
            $orders->where('admin_id', $request->staff_id);
        }

        if ($request->has('start_d') && $request->has('end_d')) {
            $orders->whereBetween(request('date_type', 'created_at'), [
                $_start->startOfDay()->toDateTimeString(),
                $_end->endOfDay()->toDateTimeString(),
            ]);
        }

        $orders = $orders->when($request->role_id == Admin::SALESMAN, function ($orders) {
            $orders->where('admin_id', request('admin_id'));
        });
        $orders = $orders->when(!$request->has('order'), function ($orders) {
            $orders->latest('id');
        });

        return DataTables::of($orders)
            ->addIndexColumn()
            ->setRowAttr([
                'style' => function ($row) {
                    if ($row->data->is_fraud ?? false) {
                        return 'background: #ff9e9e';
                    }
                    if (!($row->data->is_fraud ?? false) && ($row->data->is_repeat ?? false)) {
                        return 'background: #ffeeaa';
                    }
                },
            ])
            ->editColumn('id', function ($row) {
                return '<a class="btn btn-light btn-sm text-nowrap px-2" href="' . route('admin.orders.edit', $row->id) . '">' . $row->id . '<i class="fa fa-eye ml-1"></i></a>';
            })
            ->editColumn('created_at', function ($row) {
                return "<div class='text-nowrap'>" . $row->created_at->format('d-M-Y') . "<br>" . $row->created_at->format('h:i A') . "</div>";
            })
            ->addColumn('amount', function ($row) {
                return $row->data->subtotal + $row->data->shipping_cost - ($row->data->discount ?? 0) - ($row->data->advanced ?? 0);
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="form-control" name="order_id[]" value="' . $row->id . '" style="height: 20px;">';
            })
            ->editColumn('customer', function ($row) {
                return "
                    <div>
                        <div><i class='fa fa-user mr-1'></i>{$row->name}</div>
                        <div><i class='fa fa-phone mr-1'></i><a href='tel:{$row->phone}'>{$row->phone}</a></div>
                        <div><i class='fa fa-map-marker mr-1'></i>{$row->address}</div>" .
                    ($row->note ? "<div class='text-danger'><i class='fa fa-sticky-note-o mr-1'></i>{$row->note}</div>" : '') .
                    "</div>";
            })
            ->editColumn('products', function ($row) {
                $products = '<ul style="list-style: auto; padding-left: 1rem;">';
                foreach ($row->products as $product) {
                    $products .= "<li><a class='text-underline' href='" . route('products.show', $product->slug) . "' target='_blank'>{$product->name}</a> x{$product->quantity}</li>";
                }
                return $products . '</ul>';
            })
            ->addColumn('courier', function ($row) {
                if (!($row->data->courier ?? false) || !($row->data->consignment_id ?? false)) return '';

                if ($row->data->courier == 'Pathao') {
                    $link = 'https://merchant.pathao.com/tracking?consignment_id=' . $row->data->consignment_id . '&phone=' . Str::after($row->phone, '+88');
                } else if ($row->data->courier == 'SteadFast') {
                    $link = 'https://www.steadfast.com.bd/consignment/' . $row->data->consignment_id;
                } else {
                    $link = '';
                }

                return '
                    <div style="white-space: nowrap;">Carrier: ' . $row->data->courier . '</div>
                    <div style="white-space: nowrap;">C.ID: <a href="' . $link . '" target="_blank">' . $row->data->consignment_id . '</a></div>
                    <div style="white-space: nowrap; display: none;">Tracking Code: <a href="https://www.steadfast.com.bd/?tracking_code=" target="_blank"></a></div>
                ';
            })
            ->filterColumn('customer', function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('courier', function ($query, $keyword) {
                $query->where('data->courier', 'like', '%' . $keyword . '%')
                    ->orWhere('data->consignment_id', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                [$start, $end] = explode(' - ', $keyword);
                $query->whereBetween('created_at', [
                    Carbon::parse($start)->startOfDay(),
                    Carbon::parse($end)->endOfDay(),
                ]);
            })
            ->rawColumns(['checkbox', 'id', 'customer', 'products', 'courier', 'created_at', 'actions'])
            ->make(true);
    }
}
