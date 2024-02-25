<?php

namespace App\Http\Livewire;

use App\Order;
use App\Product;
use Livewire\Component;

class OrderProductManager extends Component
{
    public Order $order;

    public $search;

    public $options = [];

    public function addProduct(Product $product)
    {
        foreach ($this->order->products as $orderedProduct) {
            if ($orderedProduct->id === $product->id) {
                return redirect()->route('admin.orders.edit', $this->order)->with('danger', 'Product Is Already In This Order.');
            }
        }

        $quantity = 1;
        $id = $product->id;
        // Manage Stock
        if ($product->should_track) {
            if ($product->stock_count <= 0) {
                return redirect()->route('admin.orders.edit', $this->order)->withDanger('Stock Out.');
            }
            $quantity = $product->stock_count >= $quantity ? $quantity : $product->stock_count;
            $product->decrement('stock_count', $quantity);
        }

        $products = (array)$this->order->products;
        $products[] = [
            'id' => $id,
            'name' => $product->var_name,
            'slug' => $product->slug,
            'image' => $product->base_image->src,
            'price' => $product->selling_price,
            'quantity' => $quantity,
            'total' => $quantity * $product->selling_price,
        ];

        $this->order->update([
            'products' => json_encode($products),
            'data' => [
                'subtotal' => $this->order->getSubtotal($products),
            ]
        ]);

        return redirect()->route('admin.orders.edit', $this->order);
    }

    public function render()
    {
        $products = collect();
        if (strlen($this->search) > 2) {
            $products = Product::with('variations.options')
                ->where('name', 'like', "%$this->search%")
                ->whereNull('parent_id')
                ->whereIsActive(1)
                ->take(5)
                ->get();
            
            foreach ($products as $product) {
                if ($product->variations->isNotEmpty() && !isset($this->options[$product->id])) {
                    $this->options[$product->id] = $product->variations->random()->options->pluck('id', 'attribute_id');
                }
            }
        }

        return view('livewire.order-product-manager', [
            'products' => $products,
        ]);
    }
}
