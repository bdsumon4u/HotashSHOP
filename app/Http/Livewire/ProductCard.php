<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

class ProductCard extends Component
{
    public Product $product;

    public function orderNow()
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$this->product->id])) {
            $cart[$this->product->id]['quantity']++;
        } else {
            $cart[$this->product->id] = [
                'id' => $this->product->id,
                'parent_id' => $this->product->parent_id ?? $this->product->id,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
                'image' => optional($this->product->base_image)->src,
                'category' => $this->product->category,
                'quantity' => 1,
                'price' => $this->product->price,
                'max' => $this->product->should_track ? $this->product->stock : -1,
            ];
        }

        $ecommerce = [
            'currency' => 'BDT',
            'value' => $cart[$this->product->id]['price']*$cart[$this->product->id]['quantity'],
            'items' => array_values(array_map(function ($product) {
                return [
                    'item_id' => $product['id'],
                    'item_name' => $product['name'],
                    'item_category' => $product['category'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ];
            }, $cart)),
        ];
        GoogleTagManagerFacade::flash([
            'event' => 'add_to_cart',
            'ecommerce' => $ecommerce,
        ]);
        session()->put('cart', $cart);

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
