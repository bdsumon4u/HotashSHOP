<?php

namespace App\Http\Livewire;

use App\Notifications\User\OrderConfirmed;
use App\Order;
use App\Pathao\Facade\Pathao;
use App\Product;
use App\User;
use Fuse\Fuse;
use Illuminate\Support\Arr;
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
            'order.data.shipping_area' => 'required',
            'order.data.shipping_cost' => 'required|integer',
            'order.data.courier' => 'required',
            'order.data.city_id' => 'nullable|integer',
            'order.data.area_id' => 'nullable|integer',
            'order.data.weight' => 'nullable|numeric',
        ];
    }

    protected function prepareForValidation($attributes): array
    {
        if (Str::startsWith($attributes['order']['phone'], '01')) {
            $attributes['order']['phone'] = '+88' . $attributes['order']['phone'];
        }

        $data = Arr::get($attributes, 'order.data', []);

        if ($data['discount'] ?? false) {
            $data['discount'] = ltrim($data['discount'], '0');
        }
        if (!$data['discount']) $data['discount'] = '0';

        if ($data['advanced'] ?? false) {
            $data['advanced'] = ltrim($data['advanced'], '0');
        }
        if (!$data['advanced']) $data['advanced'] = '0';

        if ($data['shipping_cost'] ?? false) {
            $data['shipping_cost'] = ltrim($data['shipping_cost'], '0');
        }
        if (!$data['shipping_cost']) $data['shipping_cost'] = '0';

        $attributes['order']['data'] = $data;

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

        $this->search = '';
        $this->dispatchBrowserEvent('notify', ['message' => 'Product added successfully.']);
    }

    public function increaseQuantity($id)
    {
        $this->selectedProducts[$id]['quantity']++;
        $this->selectedProducts[$id]['total'] = $this->selectedProducts[$id]['quantity'] * $this->selectedProducts[$id]['price'];
    }

    public function decreaseQuantity($id)
    {
        if ($this->selectedProducts[$id]['quantity'] > 1) {
            $this->selectedProducts[$id]['quantity']--;
            $this->selectedProducts[$id]['total'] = $this->selectedProducts[$id]['quantity'] * $this->selectedProducts[$id]['price'];
        } else {
            unset($this->selectedProducts[$id]);
        }
    }

    public function updatedOrderDataShippingArea($value)
    {
        $this->order->fill(['data' => [
            'shipping_cost' => setting('delivery_charge')->{$this->order->data['shipping_area'] == 'Inside Dhaka' ? 'inside_dhaka' : 'outside_dhaka'} ?? config('services.shipping.' . $this->order->data['shipping_area'], 0),
        ]]);
    }

    public function updateOrder()
    {
        $this->validate();

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

            if ($confirming && ($user = $this->order->user)) {
                $user->notify(new OrderConfirmed($this->order));
            }

            session()->flash('success', 'Order updated successfully.');
        } else {
            $this->order->fill([
                'user_id' => $this->getUser()->id,
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

    private function getUser()
    {
        if ($user = auth('user')->user()) {
            return $user;
        }

        $user = User::query()->firstOrCreate(
            ['phone_number' => $this->order->phone],
            array_merge([
                'name' => $this->order->name,
                'email' => $this->order->email,
            ], [
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ])
        );

        // $user->notify(new AccountCreated());

        return $user;
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

        $this->order->fill(['data' => [
            'subtotal' => $this->order->getSubtotal($this->selectedProducts),
        ]]);
        if (empty($this->order->data['courier'] ?? '')) {
            $this->order->fill(['data' => [
                'courier' => 'Other',
            ]]);
        }

        return view('livewire.edit-order', [
            'products' => $products,
        ]);
    }
}
