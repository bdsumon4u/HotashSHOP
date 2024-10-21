<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PathaoExport;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Notifications\User\OrderConfirmed;
use App\Pathao\Facade\Pathao;
use App\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    private $base_url = 'https://portal.steadfast.com.bd/api/v1';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->has('status')) {
            return redirect()->route('admin.orders.index', ['status' => 'PENDING']);
        }

        return $this->view();
    }

    public function create()
    {
        return $this->view();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->view([
            'orders' => Order::with('admin')
                // ->where('user_id', $order->user_id)
                ->where('phone', $order->phone)
                ->where('id', '!=', $order->id)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return $this->view([
            'orders' => Order::with('admin')
                // ->where('user_id', $order->user_id)
                ->where('phone', $order->phone)
                ->where('id', '!=', $order->id)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    public function filter(Request $request)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        $_start = Carbon::parse(\request('start_d', date('Y-m-d')));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');

        $totalSQL = 'COUNT(*) as order_count, SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.subtotal"))) + SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.shipping_cost"))) - COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(data, "$.discount"))), 0) as total_amount';

        $orderQ = Order::select('id', 'products')
            ->whereBetween(request('date_type', 'status_at'), [
                $_start->startOfDay()->toDateTimeString(),
                $_end->endOfDay()->toDateTimeString(),
            ]);

        $orderQ->whereBetween($request->get('date_type', 'status_at'), [
            $_start->startOfDay()->toDateTimeString(),
            $_end->endOfDay()->toDateTimeString(),
        ]);

        if ($request->staff_id) {
            $orderQ->where('admin_id', $request->staff_id);
        }

        if ($request->courier) {
            $orderQ->whereJsonContains('data->courier', $request->courier);
        }

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

        $productInOrders[] = [];

        $products = $orderQ
            ->when($request->status, fn($q) => $q->where('status', $request->status))->get()
            ->flatMap(function ($order) use (&$productInOrders) {
                $products = json_decode(json_encode($order->products, JSON_UNESCAPED_UNICODE), true);

                foreach ($products as $product) {
                    $productInOrders[$product['name']][$order->id] = 1 + ($productInOrders[$product['name']][$order->id] ?? 0);
                }

                return $products;
            })
            ->groupBy('id')->map(function ($item) {
                return [
                    'name' => $item->random()['name'],
                    'slug' => $item->random()['slug'],
                    'quantity' => $item->sum('quantity'),
                    'total' => $item->sum('total'),
                ];
            })->sortByDesc('quantity')->toArray();

        return view('admin.orders.filter', [
            'start' => $start,
            'end' => $end,
            'orders' => $orders,
            'amounts' => $amounts,
            'products' => $products,
            'productInOrders' => $productInOrders,
        ]);
    }

    public function invoices(Request $request)
    {
        $request->validate(['order_id' => 'required']);
        $order_ids = explode(',', $request->order_id);
        $order_ids = array_map('trim', $order_ids);
        $order_ids = array_filter($order_ids);

        $orders = Order::whereIn('id', $order_ids)->get();
        return view('admin.orders.invoices', compact('orders'));
    }

    public function csv(Request $request)
    {
        return Excel::download(new PathaoExport, 'pathao.csv');
    }

    public function booking(Request $request)
    {
        $request->validate(['order_id' => 'required']);
        $order_ids = explode(',', $request->order_id);
        $order_ids = array_map('trim', $order_ids);
        $order_ids = array_filter($order_ids);

        $booked = 0;
        try {
            $booked = $this->steadFast($order_ids);
        } catch (\Exception $e) {
            return redirect()->back()->withDanger($e->getMessage());
        }

        if (setting('Pathao')->enabled ?? false) {
            foreach (Order::whereIn('id', $order_ids)->where('data->courier', 'Pathao')->get() as $order) {
                try {
                    $this->pathao($order);
                    $booked++;
                } catch (\App\Pathao\Exceptions\PathaoException $e) {
                    $errors = collect($e->errors)->values()->flatten()->toArray();
                    $message = $errors[0] ?? $e->getMessage();
                    if ($message == 'Too many attempts') {
                        $message = 'Booked ' . $booked . ' out of ' . count($order_ids) . ' orders. Please try again later.';
                    }
                    return back()->withDanger($message);
                } catch (\Exception $e) {
                    return back()->withDanger($e->getMessage());
                }
            }
        }

        return redirect()->back() //$this->invoices($request);
            ->withSuccess('Orders are sent to Courier.');
    }

    private function steadFast($order_ids)
    {
        if (!(($SteadFast = setting('SteadFast'))->enabled ?? false)) return 0;
        $orders = Order::whereIn('id', $order_ids)->where('data->courier', 'SteadFast')->get()->map(function ($order) {
            return [
                'invoice' => $order->id,
                'recipient_name' => $order->name ?? 'N/A',
                'recipient_address' => $order->address ?? 'N/A',
                'recipient_phone' => $order->phone ?? '',
                'cod_amount' => intval($order->data['shipping_cost']) + intval($order->data['subtotal']) - intval($order->data['advanced'] ?? 0) - intval($order->data['discount'] ?? 0),
                'note' => $order->note,
            ];
        })->toJson();

        $response = Http::withHeaders([
            'Api-Key' => $SteadFast->key,
            'Secret-Key' => $SteadFast->secret,
            'Content-Type' => 'application/json'
        ])->post($this->base_url . '/create_order/bulk-order', [
            'data' => $orders,
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['data'] ?? [] as $item) {
            if (!$order = Order::find($item['invoice'])) continue;

            $order->update([
                'status' => 'SHIPPING',
                'status_at' => now()->toDateTimeString(),
                'data' => [
                    'consignment_id' => $item['consignment_id'],
                    'tracking_code' => $item['tracking_code'],
                ],
            ]);
        }

        return count($data['data'] ?? []);
    }

    private function pathao($order)
    {
        $data = [
            "store_id"            => setting('Pathao')->store_id, // Find in store list,
            "merchant_order_id"   => $order->id, // Unique order id
            "recipient_name"      => $order->name ?? 'N/A', // Customer name
            "recipient_phone"     => Str::after($order->phone, '+88') ?? '', // Customer phone
            "recipient_address"   => $order->address ?? 'N/A', // Customer address
            "recipient_city"      => $order->data['city_id'], // Find in city method
            "recipient_zone"      => $order->data['area_id'], // Find in zone method
            // "recipient_area"      => "", // Find in Area method
            "delivery_type"       => 48, // 48 for normal delivery or 12 for on demand delivery
            "item_type"           => 2, // 1 for document, 2 for parcel
            "special_instruction" => $order->note,
            "item_quantity"       => 1, // item quantity
            "item_weight"         => $order->data['weight'] ?? 0.5, // parcel weight
            "amount_to_collect"   => intval($order->data['shipping_cost']) + intval($order->data['subtotal']) - intval($order->data['advanced'] ?? 0) - intval($order->data['discount'] ?? 0), // - $order->deliveryCharge, // amount to collect
            // "item_description"    => $this->getProductsDetails($order->id), // product details
        ];

        $data = \App\Pathao\Facade\Pathao::order()->create($data);

        $order->update([
            'status' => 'SHIPPING',
            'status_at' => now()->toDateTimeString(),
            'data' => [
                'consignment_id' => $data->consignment_id,
            ],
        ]);
    }

    public function courier(Request $request)
    {
        $request->validate([
            'courier' => 'required',
            'order_id' => 'required|array',
        ]);

        Order::whereIn('id', $request->order_id)
            ->get()->map->update(['data' => ['courier' => $request->courier]]);

        return redirect()->back()->withSuccess('Courier Has Been Updated.');
    }

    public function status(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'order_id' => 'required|array',
        ]);

        $data['status'] = $request->status;
        $data['status_at'] = now()->toDateTimeString();
        $orders = Order::whereIn('id', $request->order_id)->where('status', '!=', $request->status)->get();

        $orders->each->update($data);

        if ($request->status == 'CONFIRMED') {
            $orders->each(fn ($order) => $order->user->notify(new OrderConfirmed($order)));
        }

        return redirect()->back()->withSuccess('Order Status Has Been Updated.');
    }

    public function staff(Request $request)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        $request->validate([
            'admin_id' => 'required',
            'order_id' => 'required|array',
        ]);

        $data['admin_id'] = $request->admin_id;
        Order::whereIn('id', $request->order_id)->where('admin_id', '!=', $request->admin_id)->update($data);

        return redirect()->back()->withSuccess('Order Staff Has Been Updated.');
    }

    public function updateQuantity(Request $request, Order $order)
    {
        $quantities = $request->quantity;
        $productIDs = collect($order->products)
            ->map(function ($product) {
                return $product->id;
            });
        $products = Product::find($productIDs)
            ->map(function (Product $product) use ($quantities) {
                if ($quantity = data_get($quantities, $product->id)) {
                    if ($product->should_track) {
                        if ($product->quantity > $quantity) {
                            $product->increment('stock_count', $product->quantity - $quantity);
                        } elseif ($quantity > $product->quantity) {
                            $quantity = $product->stock_count >= $quantity ? $quantity : $product->stock_count;
                            $product->decrement('stock_count', $quantity - $product->quantity);
                        }
                    }
                    if ($quantity > 0) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'image' => optional($product->base_image)->src,
                            'price' => $selling = $product->getPrice($quantity),
                            'quantity' => $quantity,
                            'total' => $quantity * $selling,
                        ];
                    }
                }
            })->filter(function ($product) {
                return $product != null; // Only Available Products
            })->toArray();

        $order->update([
            'products' => json_encode($products, JSON_UNESCAPED_UNICODE),
            'data' => [
                'subtotal' => $order->getSubtotal($products),
            ],
        ]);

        return back()->with('success', $order->getChanges() ? 'Order Updated.' : 'Not Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        abort_unless(request()->user()->is('admin'), 403, 'You don\'t have permission.');
        $products = is_array($order->products) ? $order->products : get_object_vars($order->products);
        array_map(function ($product) {
            if ($product = Product::find($product->id)) {
                $product->should_track && $product->increment('stock_count', intval($product->quantity));
            }
            return null;
        }, $products);
        
        DB::transaction(function () use ($order) {
            $phone = $order->phone;
            $order->delete();

            // update data.is_fraud, data.is_repeat for other orders
            $orders = Order::where('phone', $phone)->get();
            // is_fraud
            $orders->each(function ($order) use ($orders) {
                // where order_id is less than $order->id and status is CANCELLED or RETURNED
                $order->update([
                    'data' => [
                        'is_fraud' => $orders->where('id', '<', $order->id)->whereIn('status', ['CANCELLED', 'RETURNED'])->count() > 0,
                        'is_repeat' => $orders->where('id', '<', $order->id)->count() > 0,
                    ],
                ]);
            });
        });

        return request()->expectsJson() ? true : redirect(action([self::class, 'index']))
            ->with('success', 'Order Has Been Deleted.');
    }
}
