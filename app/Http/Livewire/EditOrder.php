<?php

namespace App\Http\Livewire;

use App\Order;
use App\Pathao\Facade\Pathao;
use App\Product;
use Livewire\Component;

class EditOrder extends Component
{
    public ?Order $order = null;

    public array $data = [];

    public array $selectedProducts = [];

    public $search;

    public $options = [];

    public ?string $name = '';
    public ?string $phone = '';
    public ?string $email = '';
    public ?string $status = '';
    public ?string $address = '';
    public ?string $shipping = '';
    public ?string $note = '';

    public function mount(?Order $order = null)
    {
        if (! $order->exists) {
            $this->order = new Order([
                'admin_id' => auth('admin')->id(),
                'status' => 'CONFIRMED',
                'phone' => '+880',
                'data' => [
                    'subtotal' => 0,
                    'shipping_cost' => 0,
                    'advanced' => 0,
                    'discount' => 0,
                    'courier' => '',
                    'city_id' => '',
                    'area_id' => '',
                ],
            ]);
        } else {
            $this->order = $order;
        }

        $this->data = (array)$this->order->data;
        $this->shipping = $this->data['shipping_area'] ?? '';
        $this->selectedProducts = json_decode(json_encode($this->order->products), true) ?? [];
        $this->fill($this->order->only('name', 'phone', 'email', 'address', 'status', 'note'));
    }

    public function updatedShipping($value)
    {
        $this->data['shipping_area'] = $value;
        $this->data['shipping_cost'] = setting('delivery_charge')->{$value == 'Inside Dhaka' ? 'inside_dhaka' : 'outside_dhaka'} ?? config('services.shipping.' . $value, 0);
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

        $this->selectedProducts[] = [
            'id' => $id,
            'name' => $product->var_name,
            'slug' => $product->slug,
            'image' => $product->base_image->src,
            'price' => $product->selling_price,
            'quantity' => $quantity,
            'total' => $quantity * $product->selling_price,
        ];

        $this->data['subtotal'] = $this->order->getSubtotal($this->selectedProducts);
    }

    public function increaseQuantity($id)
    {
        foreach ($this->selectedProducts as $key => $product) {
            if ($product['id'] === $id) {
                $this->selectedProducts[$key]['quantity']++;
                $this->selectedProducts[$key]['total'] = $this->selectedProducts[$key]['quantity'] * $this->selectedProducts[$key]['price'];
                break;
            }
        }

        $this->data['subtotal'] = $this->order->getSubtotal($this->selectedProducts);
    }

    public function decreaseQuantity($id)
    {
        foreach ($this->selectedProducts as $key => $product) {
            if ($product['id'] === $id) {
                if ($this->selectedProducts[$key]['quantity'] > 1) {
                    $this->selectedProducts[$key]['quantity']--;
                    $this->selectedProducts[$key]['total'] = $this->selectedProducts[$key]['quantity'] * $this->selectedProducts[$key]['price'];
                } else {
                    unset($this->selectedProducts[$key]);
                }
                break;
            }
        }

        $this->data['subtotal'] = $this->order->getSubtotal($this->selectedProducts);
    }

    public function updateOrder()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+8801\d{9}$/',
            'email' => 'nullable',
            'address' => 'required',
            'note' => 'nullable',
            'status' => 'required',
            'shipping' => 'required',
            'data.discount' => 'nullable|integer',
            'data.advanced' => 'nullable|integer',
            'data.shipping_cost' => 'required|integer',
            'data.courier' => 'nullable',
            'data.city_id' => 'nullable',
            'data.area_id' => 'nullable',
        ]);

        if (empty($this->selectedProducts)) {
            return session()->flash('error', 'Please add products to the order.');
        }

        if ($this->order->exists) {
            if ($this->status != $this->order->status) {
                $this->order->forceFill(['status_at' => now()->toDateTimeString()]);
            }

            $this->order->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
                'status' => $this->status,
                'note' => $this->note,
                'data' => $this->data,
                'products' => json_encode($this->selectedProducts),
            ]);

            session()->flash('success', 'Order updated successfully.');
        } else {
            $this->order->fill([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
                'status' => $this->status,
                'note' => $this->note,
                'data' => $this->data,
                'type' => Order::MANUAL,
                'status_at' => now()->toDateTimeString(),
                'products' => json_encode($this->selectedProducts),
            ])->save();

            session()->flash('success', 'Order created successfully.');

            return redirect()->route('admin.orders.index', ['status' => 'CONFIRMED']);
        }

        return redirect()->route('admin.orders.index');
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

        $areas = [];
        $cities = cache()->remember('pathao_cities', now()->addDay(), function () {
            return Pathao::area()->city()->data;
        });

        if ($this->data['city_id'] ?? false) {
            $areas = cache()->remember('pathao_areas:' . $this->data['city_id'], now()->addDay(), function () {
                return Pathao::area()->zone($this->data['city_id'])->data;
            });
        }

        return view('livewire.edit-order', [
            'cities' => $cities,
            'areas' => $areas,
            'products' => $products,
        ]);
    }
}
