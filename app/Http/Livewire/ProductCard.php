<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

class ProductCard extends Component
{
    public Product $product;

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $fraudQuantity = setting('fraud')->max_qty_per_product ?? 3;

        if (!isset($cart[$this->product->id])) {
            $cart[$this->product->id] = [
                'id' => $this->product->id,
                'parent_id' => $this->product->parent_id ?? $this->product->id,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
                'image' => optional($this->product->base_image)->path,
                'category' => $this->product->category,
                'quantity' => 1,
                'price' => $this->product->selling_price,
                'max' => $this->product->should_track ? min($this->product->stock_count, $fraudQuantity) : $fraudQuantity,
            ];
        }

        session()->put('cart', $cart);
        $product = $cart[$this->product->id];

        $this->dispatchBrowserEvent('dataLayer', [
            'event' => 'add_to_cart',
            'ecommerce' => [
                'currency' => 'BDT',
                'value' => $product['price']*$product['quantity'],
                'items' => [
                    [
                        'item_id' => $product['id'],
                        'item_name' => $product['name'],
                        'item_category' => $product['category'],
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                    ]
                ],
            ],
        ]);

        $this->emit('cartUpdated');
        $this->dispatchBrowserEvent('notify', ['message' => 'Product added to cart']);
    }

    public function orderNow()
    {
        $this->addToCart();

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
