<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\CheckoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CheckoutRequest $request)
    {
        if ($request->isMethod('GET')) {
            return view('checkout');
        }

        $data = $request->validated();

        $order = null;
        DB::transaction(function () use ($data, &$order) {
            $products = Product::find(array_keys($data['products']))
                ->map(function (Product $product) use ($data) {
                    $id = $product->id;
                    $quantity = $data['products'][$id];

                    // Manage Stock
                    if ($product->should_track) {
                        if ($product->stock_count <= 0) {
                            return null;
                        }
                        $product->decrement('stock_count', $quantity);
                    }

                    // Needed Attributes
                    return [
                        'id' => $id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'image' => $product->base_image->src,
                        'price' => $product->selling_price,
                        'quantity' => $product->stock_count >= $quantity ? $quantity : $product->stock_count,
                        'total' => $quantity * $product->selling_price,
                    ];
                })->filter(function ($product) {
                    return $product != null; // Only Available Products
                })->toArray();

            $data['products'] = json_encode($products);
            $data += [
                'user_id' => optional(auth('user')->user())->id, // If User Logged In
                'status' => data_get(config('app.orders', []), 0, 'PENDING'), // Default Status
                // Additional Data
                'data' => json_encode([
                    'shipping_area' => $data['shipping'],
                    'shipping_cost' => config('services.shipping.'.$data['shipping']),
                    'subtotal'      => array_reduce($products, function ($sum, $product) {
                        return $sum += $product['total'];
                    }),
                ]),
            ];

            $order = Order::create($data);
        });

        $data['email'] && Mail::to($data['email'])->queue(new OrderPlaced($order));

        return redirect()->route('track-order', [
            'phone' => $data['phone'],
            'order' => optional($order)->getKey(),
        ]);
    }
}
