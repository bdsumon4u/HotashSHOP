<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable',
            'address' => 'required',
            'note' => 'nullable',
            'products' => 'required|array',
            'shipping' => 'required',
        ]);

        $products = Product::find(array_keys($data['products']))
            ->map(function (Product $product) use ($data) {
                $id = $product->id;
                return [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->base_image->src,
                    'price' => $product->price,
                    'quantity' => $data['products'][$id],
                    'total' => $data['products'][$id] * $product->price,
                ];
            })->toArray();

        $data['products'] = json_encode($products);
        $data += [
            // 'user_id' => 0,
            'data' => json_encode([
                'shipping_area' => $data['shipping'],
                'shipping_cost' => config('services.shipping.'.$data['shipping']),
                'subtotal'      => array_reduce($products, function ($sum, $product) {
                    return $sum += $product['total'];
                }),
            ]),
        ];

        return redirect()->route('checkout.done', [$data['phone'], Order::create($data)->getKey()]);
    }

    public function done($phone, $id)
    {
        return view('post-checkout')
            ->withOrder(
                Order::where(compact('phone', 'id'))
                    ->firstOrFail()
            );
    }
}
