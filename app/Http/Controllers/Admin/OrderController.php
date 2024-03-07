<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Pathao\Facade\Pathao;
use App\Product;
use Illuminate\Support\Carbon;

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
            'orders' => Order::where('user_id', $order->user_id)->where('id', '!=', $order->id)->orderBy('id', 'desc')->get(),
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
            'orders' => Order::with('admin')->where('user_id', $order->user_id)->where('id', '!=', $order->id)->orderBy('id', 'desc')->get(),
        ]);
    }

    public function filter(Request $request)
    {
        $_start = Carbon::parse(\request('start_d', '1970-01-01'));
        $start = $_start->format('Y-m-d');
        $_end = Carbon::parse(\request('end_d'));
        $end = $_end->format('Y-m-d');

        $orders = Order::select('id', 'products');
        if ($request->status) {
            $orders->where('status', $request->status);
        }
        $orders->whereBetween($request->get('date_type', 'created_at'), [
            $_start->startOfDay()->toDateTimeString(),
            $_end->endOfDay()->toDateTimeString(),
        ]);

        if ($request->staff_id) {
            $orders->where('admin_id', $request->staff_id);
        }

        return view('admin.orders.filter', [
            'start' => $start,
            'end' => $end,
            'products' => $orders->get()
                ->flatMap(fn ($order) => json_decode(json_encode($order->products), true))
                ->groupBy('id')->map(function ($item) {
                    return [
                        'name' => $item->random()['name'],
                        'slug' => $item->random()['slug'],
                        'quantity' => $item->sum('quantity'),
                        'total' => $item->sum('total'),
                    ];
                })->sortByDesc('quantity')->toArray(),
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

    public function courier(Request $request)
    {
        $request->validate(['order_id' => 'required']);
        $order_ids = explode(',', $request->order_id);
        $order_ids = array_map('trim', $order_ids);
        $order_ids = array_filter($order_ids);

        try {
            $this->steadFast($order_ids);
        } catch (\Exception $e) {
            return redirect()->back()->withDanger($e->getMessage());
        }

        if (setting('Pathao')->enabled) {
            foreach (Order::whereIn('id', $order_ids)->where('data->courier', 'Pathao')->get() as $order) {
                try {
                    $this->pathao($order);
                } catch (\App\Pathao\Exceptions\PathaoException $e) {
                    $errors = collect($e->errors)->values()->flatten()->toArray();
                    return back()->withDanger($errors[0] ?? $e->getMessage());
                } catch (\Exception $e) {
                    return back()->withDanger($e->getMessage());
                }
            }
        }

        return $this->invoices($request);
            // ->withSuccess('Orders are sent to Courier.')
        ;
    }

    private function steadFast($order_ids)
    {
        if (!setting('SteadFast')->enabled) return;
        $orders = Order::whereIn('id', $order_ids)->where('data->courier', 'SteadFast')->get()->map(function ($order) {
            return [
                'invoice' => $order->id,
                'recipient_name' => $order->name ?? 'N/A',
                'recipient_address' => $order->address ?? 'N/A',
                'recipient_phone' => $order->phone ?? '',
                'cod_amount' => $order->data->shipping_cost + $order->data->subtotal - ($order->data->advanced ?? 0) - ($order->data->discount ?? 0),
                'note' => $order->note,
            ];
        })->toJson();

        $response = Http::withHeaders([
            'Api-Key' => config('services.stdfst.key'),
            'Secret-Key' => config('services.stdfst.secret'),
            'Content-Type' => 'application/json'
        ])->post($this->base_url . '/create_order/bulk-order', [
            'data' => $orders,
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['data'] ?? [] as $item) {
            if (!$order = Order::find($item['invoice'])) continue;

            $order->update([
                'status' => 'SHIPPING',
                'data' => [
                    'consignment_id' => $item['consignment_id'],
                    'tracking_code' => $item['tracking_code'],
                ],
            ]);
        }
    }

    private function pathao($order)
    {
        $data = [
            "store_id"            => setting('Pathao')->store_id, // Find in store list,
            "merchant_order_id"   => $order->id, // Unique order id
            "recipient_name"      => $order->name ?? 'N/A', // Customer name
            "recipient_phone"     => Str::after($order->phone, '+88') ?? '', // Customer phone
            "recipient_address"   => $order->address ?? 'N/A', // Customer address
            "recipient_city"      => $order->data->city_id, // Find in city method
            "recipient_zone"      => $order->data->area_id, // Find in zone method
            // "recipient_area"      => "", // Find in Area method
            "delivery_type"       => 48, // 48 for normal delivery or 12 for on demand delivery
            "item_type"           => 2, // 1 for document, 2 for parcel
            "special_instruction" => $order->note,
            "item_quantity"       => 1, // item quantity
            "item_weight"         => 0.5, // parcel weight
            "amount_to_collect"   => $order->data->shipping_cost + $order->data->subtotal - ($order->data->advanced ?? 0) - ($order->data->discount ?? 0), // - $order->deliveryCharge, // amount to collect
            // "item_description"    => $this->getProductsDetails($order->id), // product details
        ];

        $data = \App\Pathao\Facade\Pathao::order()->create($data);

        $order->update([
            'status' => 'SHIPPING',
            'data' => [
                'consignment_id' => $data->consignment_id,
            ],
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'order_id' => 'required|array',
        ]);

        $data['status'] = $request->status;
        $data['status_at'] = now()->toDateTimeString();
        Order::whereIn('id', $request->order_id)->update($data);

        return redirect()->back()->withSuccess('Order Status Has Been Updated.');
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
                            'image' => $product->base_image->src,
                            'price' => $product->selling_price,
                            'quantity' => $quantity,
                            'total' => $quantity * $product->selling_price,
                        ];
                    }
                }
            })->filter(function ($product) {
                return $product != null; // Only Available Products
            })->toArray();

        $order->update([
            'products' => json_encode($products),
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
        abort_unless(request()->user()->is('admin'), 403, 'Not Allowed.');
        $products = is_array($order->products) ? $order->products : get_object_vars($order->products);
        array_map(function ($product) {
            if ($product = Product::find($product->id)) {
                $product->should_track && $product->increment('stock_count', intval($product->quantity));
            }
            return null;
        }, $products);
        $order->delete();
        return request()->expectsJson() ? true : redirect(action([self::class, 'index']))
            ->with('success', 'Order Has Been Deleted.');
    }
}
