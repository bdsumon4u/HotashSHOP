<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class FreeDelivery extends Component
{
    public array $selectedProducts = [];

    public int $free_delivery;
    public int $free_for_all;

    public $search;

    public function mount($freeDelivery = null)
    {
        $this->free_delivery = $freeDelivery->enabled ?? 0;
        $this->free_for_all = $freeDelivery->for_all ?? 0;

        $products = (array)$freeDelivery->products ?? [];
        Product::find(array_keys($products))->each(function ($product) use ($products) {
            $this->addProduct($product, $products[$product->id]);
        });
    }

    public function addProduct(Product $product, $quantity = 1)
    {
        foreach ($this->selectedProducts as $orderedProduct) {
            if ($orderedProduct['id'] === $product->id) {
                return session()->flash('error', 'Product already added.');
            }
        }

        $this->selectedProducts[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'image' => optional($product->base_image)->src,
            'quantity' => $quantity,
        ];
    }

    public function increaseQuantity($id)
    {
        $this->selectedProducts[$id]['quantity']++;
    }

    public function decreaseQuantity($id)
    {
        if ($this->selectedProducts[$id]['quantity'] > 1) {
            $this->selectedProducts[$id]['quantity']--;
        } else {
            unset($this->selectedProducts[$id]);
        }
    }

    public function render()
    {
        $products = collect();
        if (strlen($this->search) > 2) {
            $products = Product::where('name', 'like', "%$this->search%")
                ->whereNull('parent_id')
                ->whereIsActive(1)
                ->take(5)
                ->get();
        }

        return view('livewire.free-delivery', [
            'products' => $products,
        ]);
    }
}
