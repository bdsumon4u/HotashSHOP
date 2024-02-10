<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
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
        if (! request()->has('status')) {
            return redirect(action([static::class, 'index'], ['status' => 'pending']));
        }

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
            'statuses' => config('app.orders', [])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->merge([
            'phone' => Str::startsWith($request->phone, '0') ? '+88' . $request->phone : $request->phone,
        ]);
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+8801\d{9}$/',
            'email' => 'nullable',
            'address' => 'required',
            'note' => 'nullable',
            'status' => 'required',
            'shipping' => 'required',
            'data.discount' => 'required|integer',
            'data.advanced' => 'required|integer',
            'data.shipping_cost' => 'required|integer',
        ]);

        $data['data']['shipping_area'] = $data['shipping'];
        $data['data']['shipping_cost'] = setting('delivery_charge')->{$data['shipping'] == 'Inside Dhaka' ? 'inside_dhaka' : 'outside_dhaka'} ?? config('services.shipping.'.$data['shipping']);
        $data['data']['subtotal'] = $this->getSubtotal($order->products);
        if ($order->status != 'Shipping' && $data['status'] == 'Shipping') {
            $order->forceFill(['shipped_at' => now()->toDateTimeString()]);
        }

        if ($request->status != $order->status) {
            $data['status_at'] = now()->toDateTimeString();
        }

        $order->update($data);
        return redirect(route('admin.orders.index', ['status' => 'pending']))->withSuccess('Order Has Been Updated.');
    }

    protected function getSubtotal($products)
    {
        $products = (array)$products;
        return array_reduce($products, function ($sum, $product) {
            return $sum + ((array)$product)['total'];
        });
    }

    public function filter(Request $request)
    {
        $orders = Order::select('id', 'products');
        if ($request->status) {
            $orders->where('status', $request->status);
        }
        if ($request->date) {
            $orders->whereBetween('status_at', [Carbon::parse($request->date)->startOfDay(), Carbon::parse($request->date)->endOfDay()]);
        } else {
            $orders->whereBetween('status_at', [now()->startOfDay(), now()->endOfDay()]);
        }
        // if ($request->staff_id) {
        //     $orders->where('admin_id', $request->staff_id);
        // }

        return view('admin.orders.filter', [
            'products' => $orders->get()->pluck('products')->flatten()->groupBy('name')->map->count()->toArray(),
        ]);
    }

    public function scanning(Request $request)
    {
        if ($request->has('code')) {
            if ($order = Order::find($request->code)) {
                return $order;
            }
            return null;
        }

        return view('admin.orders.scanning');
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

    public function steadFast(Request $request)
    {
        $request->validate(['order_id' => 'required']);
        $order_ids = explode(',', $request->order_id);
        $order_ids = array_map('trim', $order_ids);
        $order_ids = array_filter($order_ids);

        try {
            $orders = Order::whereIn('id', $order_ids)->get()->map(function ($order) {
                return [
                    'invoice' => $order->id,
                    'recipient_name' => $order->name ?? 'N/A',
                    'recipient_address' => $order->address ?? 'N/A',
                    'recipient_phone' => $order->phone ?? '',
                    'cod_amount' => $order->data->shipping_cost + $order->data->subtotal - ($order->data->advanced ?? 0) - ($order->data->discount ?? 0),
                    'note' => '', // $order->note,
                ];
            })->toJson();
    
            $response = Http::withHeaders([
                'Api-Key' => config('services.stdfst.key'),
                'Secret-Key' => config('services.stdfst.secret'),
                'Content-Type' => 'application/json'
            ])->post($this->base_url.'/create_order/bulk-order', [
                'data' => $orders,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            foreach ($data['data'] ?? [] as $item) {
                if (!$order = Order::find($item['invoice'])) continue;
                
                $order->update([
                    'data' => [
                        'consignment_id' => $item['consignment_id'],
                        'tracking_code' => $item['tracking_code'],
                    ],
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withDanger($e->getMessage());
        }
        
        return redirect()->back()->withSuccess('Orders are sent to SteadFast.');
    }

    public function status(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'order_id' => 'required|array',
        ]);

        $data['status'] = $request->status;
        if ($request->status == 'Shipping') {
            $data['shipped_at'] = now()->toDateTimeString();
        }
        Order::whereIn('id', $request->order_id)->update($data);

        return redirect()->back()->withSuccess('Order Status Has Been Updated.');
    }

    public function addProduct(Request $request, Order $order)
    {
        if (!$product = Product::find($request->id_or_sku)) {
            if (!$product = Product::where('sku', $request->id_or_sku)->first()) {
                return back()->with('danger', 'No Product Found.');
            }
        }

        foreach ($order->products as $orderedProduct) {
            if ($orderedProduct->id === $product->id) {
                return back()->with('danger', 'Product Is Already In This Order.');
            }
        }

        $id = $product->id;
        $quantity = $request->get('new_quantity') ?? 1;
        // Manage Stock
        if ($product->should_track) {
            if ($product->stock_count <= 0) {
                return redirect()->back()->with('Stock Out.');
            }
            $quantity = $product->stock_count >= $quantity ? $quantity : $product->stock_count;
            $product->decrement('stock_count', $quantity);
        }

        $products = $order->products;
        $products[] = (object)[
            'id' => $id,
            'name' => $product->name,
            'slug' => $product->slug,
            'image' => $product->base_image->src,
            'price' => $product->selling_price,
            'quantity' => $quantity,
            'total' => $quantity * $product->selling_price,
        ];

        $order->update([
            'products' => $products,
            'data' => [
                'subtotal' => $this->getSubtotal($products),
            ]
        ]);

        return redirect()->back()->with('success', $order->getChanges() ? 'Order Updated.' : 'Not Updated.');
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
                'subtotal' => $this->getSubtotal($products),
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
        abort_if(request()->user()->role_id, 403, 'Not Allowed.');
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
