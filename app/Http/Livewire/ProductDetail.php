<?php

namespace App\Http\Livewire;

use App\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public Product $selectedVar;
    public array $options = [];

    private $freeDelivery;

    public int $quantity = 1;

    public function updatedOptions($value, $key)
    {
        $variation = $this->product->variations->first(function ($item) {
            return $item->options->pluck('id')->diff($this->options)->isEmpty();
        });

        if ($variation) {
            $this->selectedVar = $variation;
        }
    }

    public function increment()
    {
        if (!$this->selectedVar->should_track || $this->selectedVar->stock_count > $this->quantity) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function orderNow()
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$this->selectedVar->id])) {
            $cart[$this->selectedVar->id]['quantity']++;
        } else {
            $cart[$this->selectedVar->id] = [
                'id' => $this->selectedVar->id,
                'parent_id' => $this->selectedVar->parent_id ?? $this->selectedVar->id,
                'name' => $this->selectedVar->var_name,
                'slug' => $this->selectedVar->slug,
                'image' => optional($this->selectedVar->base_image)->src,
                'quantity' => $this->quantity,
                'price' => $this->selectedVar->price,
                'max' => $this->selectedVar->should_track ? $this->selectedVar->stock : -1,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('checkout');
    }

    public function mount()
    {
        $this->freeDelivery = setting('free_delivery');
        if ($this->product->variations->count() > 0) {
            $this->selectedVar = $this->product->variations->random();
        } else {
            $this->selectedVar = $this->product;
        }
        $this->options = $this->selectedVar->options->pluck('id', 'attribute_id')->toArray();
    }

    public function deliveryText()
    {
        if ($this->freeDelivery->for_all) {
            $text = '<div>ফ্রি ডেলিভারি পেতে কমপক্ষে:</div>';
            $text .= '<ul>';
            if ($this->freeDelivery->min_quantity > 0) {
                $optional = $this->freeDelivery->min_quantity > 1 ? '(একই অথবা ভিন্ন ভিন্ন) ' : '';
                $text .= '<li>'.$this->freeDelivery->min_quantity.' টি '.$optional.'প্রোডাক্ট অর্ডার করুন</li>';
            }
            if ($this->freeDelivery->min_amount > 0) {
                $text .= '<li>'.$this->freeDelivery->min_amount.' টাকা অর্ডার করুন</li>';
            }
            $text .= '</ul>';
            return $text;
        }

        if (array_key_exists($this->product->id, $products = (array)$this->freeDelivery->products ?? [])) {
            return 'এই প্রোডাক্ট ফ্রি ডেলিভারি পেতে কমপক্ষে '.$products[$this->product->id].' টি প্রোডাক্ট অর্ডার করুন';
        }

        return false;
    }

    public function render()
    {
        $optionGroup = $this->product->variations->pluck('options')->flatten()->unique('id')->groupBy('attribute_id');

        return view('livewire.product-detail', [
            'optionGroup' => $optionGroup,
            'attributes' => \App\Attribute::find($optionGroup->keys()),
            'free_delivery' => $this->freeDelivery,
            'deliveryText' => $this->deliveryText(),
        ]);
    }
}
