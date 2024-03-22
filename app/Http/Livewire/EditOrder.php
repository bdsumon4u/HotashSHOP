<?php

namespace App\Http\Livewire;

use App\Notifications\User\OrderConfirmed;
use App\Order;
use App\Pathao\Facade\Pathao;
use App\Product;
use Illuminate\Support\Str;
use Livewire\Component;

class EditOrder extends Component
{
    public Order $order;

    public array $selectedProducts = [];

    public $search;

    public $options = [];

    public function rules()
    {
        return [
            'order.name' => 'required',
            'order.phone' => 'required|regex:/^\+8801\d{9}$/',
            'order.email' => 'nullable',
            'order.address' => 'required',
            'order.note' => 'nullable',
            'order.status' => 'required',
            'order.data.discount' => 'nullable|integer',
            'order.data.advanced' => 'nullable|integer',
            'order.data.shipping_area' => 'required|integer',
            'order.data.shipping_cost' => 'required|integer',
            'order.data.courier' => 'nullable',
            'order.data.city_id' => 'nullable',
            'order.data.area_id' => 'nullable',
            'order.data.weight' => 'nullable|numeric',
        ];
    }

    protected function prepareForValidation($attributes): array
    {
        if (Str::startsWith($attributes['order']['phone'], '01')) {
            $attributes['order']['phone'] = '+88' . $attributes['order']['phone'];
        }

        return $attributes;
    }

    public function mount(Order $order)
    {
        $this->order = $order;
        $products = json_decode(json_encode($this->order->products), true) ?? [];
        foreach ($products as $product) {
            $this->selectedProducts[$product['id']] = $product;
        }
    }

    public function addProduct(Product $product)
    {
        foreach ($this->selectedProducts as $orderedProduct) {
            if ($orderedProduct['id'] === $product->id) {
                return session()->flash('error', 'Product already added.');
            }
        }

        $quantity = 1;
        $id = $product->id;
        // Manage Stock
        if ($product->should_track) {
            if ($product->stock_count <= 0) {
                return session()->flash('error', 'Out of Stock.');
            }
            $quantity = $product->stock_count >= $quantity ? $quantity : $product->stock_count;
            $product->decrement('stock_count', $quantity);
        }

        $this->selectedProducts[$id] = [
            'id' => $id,
            'name' => $product->var_name,
            'slug' => $product->slug,
            'image' => optional($product->base_image)->src,
            'price' => $product->selling_price,
            'quantity' => $quantity,
            'total' => $quantity * $product->selling_price,
        ];

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);

        $this->search = '';
        $this->dispatchBrowserEvent('notify', ['message' => 'Product added successfully.']);
    }

    public function increaseQuantity($id)
    {
        $this->selectedProducts[$id]['quantity']++;
        $this->selectedProducts[$id]['total'] = $this->selectedProducts[$id]['quantity'] * $this->selectedProducts[$id]['price'];

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);
    }

    public function decreaseQuantity($id)
    {
        if ($this->selectedProducts[$id]['quantity'] > 1) {
            $this->selectedProducts[$id]['quantity']--;
            $this->selectedProducts[$id]['total'] = $this->selectedProducts[$id]['quantity'] * $this->selectedProducts[$id]['price'];
        } else {
            unset($this->selectedProducts[$id]);
        }

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);
    }

    public function updatedOrderDataShippingArea($value)
    {
        $this->order->fill(['data' => [
            'shipping_cost' => setting('delivery_charge')->{
                $this->order->data['shipping_area'] == 'Inside Dhaka' ? 'inside_dhaka' : 'outside_dhaka'
            } ?? config('services.shipping.' . $this->order->data['shipping_area'], 0),
        ]]);

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);
    }

    public function updateOrder()
    {
        if (empty($this->selectedProducts)) {
            return session()->flash('error', 'Please add products to the order.');
        }

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);

        if ($this->order->exists) {
            $confirming = false;
            if ($this->order->isDirty('status')) {
                $confirming = $this->order->status === 'CONFIRMED';
                $this->order->forceFill([
                    'status_at' => now()->toDateTimeString(),
                ]);
            }

            $this->order->update([
                'products' => json_encode($this->selectedProducts, JSON_UNESCAPED_UNICODE),
            ]);

            if ($confirming) {
                $this->order->user->notify(new OrderConfirmed($this->order));
            }

            session()->flash('success', 'Order updated successfully.');
        } else {
            $this->order->fill([
                'admin_id' => auth('admin')->id(),
                'type' => Order::MANUAL,
                'status_at' => now()->toDateTimeString(),
                'products' => json_encode($this->selectedProducts, JSON_UNESCAPED_UNICODE),
            ])->save();

            session()->flash('success', 'Order created successfully.');

            return redirect()->route('admin.orders.edit', $this->order);
        }

        return redirect()->route('admin.orders.edit', $this->order);
    }

    public function render()
    {
        $products = collect();
        if (strlen($this->search) > 2) {
            $products = Product::with('variations.options')
                ->whereNotIn('id', array_keys($this->selectedProducts))
                ->where(fn ($q) => $q->where('name', 'like', "%$this->search%")->orWhere('sku', $this->search))
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

        $areas = [];
        $exception = false;
        $cities = cache()->remember('pathao_cities', now()->addDay(), function () use (&$exception) {
            try {
                return Pathao::area()->city()->data;
            } catch (\Exception $e) {
                $exception = true;
                return [];
            }
        });

        if ($exception) cache()->forget('pathao_cities');

        $exception = false;
        if ($this->order->data['city_id'] ?? false) {
            $areas = cache()->remember('pathao_areas:' . $this->order->data['city_id'], now()->addDay(), function () use (&$exception) {
                try {
                    return Pathao::area()->zone($this->order->data['city_id'])->data;
                } catch (\Exception $e) {
                    $exception = true;
                    return [];
                }
            });
        }

        if ($exception) cache()->forget('pathao_areas:' . $this->order->data['city_id']);

        return view('livewire.edit-order', [
            'cities' => $cities,
            'areas' => $areas,
            'products' => $products,
        ]);
    }
}
