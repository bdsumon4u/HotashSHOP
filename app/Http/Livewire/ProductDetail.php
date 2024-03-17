<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

class ProductDetail extends Component
{
    public Product $product;
    public Product $selectedVar;
    public array $options = [];
    public int $maxQuantity = 0;
    public int $quantity = 1;
    public bool $showBrandCategory = false;

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
        if ($this->quantity < $this->maxQuantity) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {

        $cart = session()->get('cart', []);
        if (isset($cart[$this->selectedVar->id])) {
            $cart[$this->selectedVar->id]['quantity'] = min($this->quantity, $this->maxQuantity);
        } else {
            $cart[$this->selectedVar->id] = [
                'id' => $this->selectedVar->id,
                'parent_id' => $this->selectedVar->parent_id ?? $this->selectedVar->id,
                'name' => $this->selectedVar->var_name,
                'slug' => $this->selectedVar->slug,
                'image' => optional($this->selectedVar->base_image)->path,
                'category' => $this->product->category,
                'quantity' => min($this->quantity, $this->maxQuantity),
                'price' => $this->selectedVar->selling_price,
                'max' => $this->maxQuantity,
            ];
        }

        $ecommerce = [
            'currency' => 'BDT',
            'value' => $cart[$this->selectedVar->id]['price']*$cart[$this->selectedVar->id]['quantity'],
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

        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('notify', ['message' => 'Product added to cart']);
    }

    public function orderNow()
    {
        $this->addToCart();

        return redirect()->route('checkout');
    }

    public function mount()
    {
        $maxPerProduct = setting('fraud')->max_qty_per_product;
        if ($this->product->variations->isNotEmpty()) {
            $this->selectedVar = $this->product->variations->where('slug', request()->segment(2))->first()
                ?? $this->product->variations->random();
        } else {
            $this->selectedVar = $this->product;
            $this->showBrandCategory = true;
        }
        $this->options = $this->selectedVar->options->pluck('id', 'attribute_id')->toArray();
        $this->maxQuantity = $this->selectedVar->should_track ? min($this->selectedVar->stock_count, $maxPerProduct) : $maxPerProduct;
    }

    public function deliveryText($freeDelivery)
    {
        if ($freeDelivery->for_all) {
            $text = '<ul class="mb-0 p-0 pl-4 list-unstyled">';
            if ($freeDelivery->min_quantity > 0) {
                $text .= '<li>কমপক্ষে <strong class="text-danger">'.$freeDelivery->min_quantity.'</strong> টি প্রোডাক্ট অর্ডার করুন</li>';
            }
            if ($freeDelivery->min_amount > 0) {
                $text .= '<li>কমপক্ষে <strong class="text-danger">'.$freeDelivery->min_amount.'</strong> টাকার প্রোডাক্ট অর্ডার করুন</li>';
            }
            $text .= '</ul>';
            return $text;
        }

        if (array_key_exists($this->product->id, $products = ((array)($freeDelivery->products ?? [])) ?? [])) {
            return 'কমপক্ষে <strong class="text-danger">'.$products[$this->product->id].'</strong> টি অর্ডার করুন';
        }

        return false;
    }

    public function render()
    {
        $optionGroup = $this->product->variations->pluck('options')->flatten()->unique('id')->groupBy('attribute_id');

        return view('livewire.product-detail', [
            'optionGroup' => $optionGroup,
            'attributes' => \App\Attribute::find($optionGroup->keys()),
            'free_delivery' => $freeDelivery = setting('free_delivery'),
            'deliveryText' => $this->deliveryText($freeDelivery),
        ]);
    }
}
