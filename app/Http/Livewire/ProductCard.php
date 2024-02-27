<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

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
                'quantity' => 1,
                'price' => $this->product->price,
                'max' => $this->product->should_track ? $this->product->stock : -1,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
