<?php

namespace App\Http\Livewire;

use App\Notifications\User\AccountCreated;
use App\Notifications\User\OrderPlaced;
use App\Admin;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

class Checkout extends Component
{
    public array $cart = [];

    protected $listeners = ['cartBoxUpdated' => 'refresh'];

    public $shipping_cost = 0;
    public $subtotal = 0;
    public $total = 0;

    public $name = '';
    public $phone = '+880';
    public $shipping = '';
    public $address = '';
    public $note = '';

    public function refresh()
    {
        $this->cart = session('cart', []);
        $this->subtotal = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $this->updatedShipping();
    }

    public function remove($id)
    {
        unset($this->cart[$id]);
        session()->put('cart', $this->cart);
        $this->cartUpdated();
    }

    public function increaseQuantity($id)
    {
        if ($this->cart[$id]['quantity'] < $this->cart[$id]['max'] || $this->cart[$id]['max'] === -1) {
            $this->cart[$id]['quantity']++;
            session()->put('cart', $this->cart);
            $this->cartUpdated();
        }
    }

    public function decreaseQuantity($id)
    {
        if ($this->cart[$id]['quantity'] > 1) {
            $this->cart[$id]['quantity']--;
        } else {
            unset($this->cart[$id]);
        }
        session()->put('cart', $this->cart);
        $this->cartUpdated();
    }

    private function shippingCost()
    {
        $shipping_cost = setting('delivery_charge')->{$this->shipping == 'Inside Dhaka' ? 'inside_dhaka' : 'outside_dhaka'} ?? config('services.shipping.' . $this->shipping);

        $freeDelivery = setting('free_delivery');

        if (!$freeDelivery->enabled) {
            return $shipping_cost;
        }

        if ($freeDelivery->for_all) {
            if ($this->subtotal < $freeDelivery->min_amount) {
                return $shipping_cost;
            }
            $quantity = array_reduce($this->cart, function ($sum, $product) {
                return $sum + $product['quantity'];
            }, 0);
            if ($quantity < $freeDelivery->min_quantity) {
                return $shipping_cost;
            }

            return 0;
        }

        // dd($this->cart, (array)$freeDelivery->products ?? []);
        
        foreach ((array)$freeDelivery->products ?? [] as $id => $qty) {
            if (collect($this->cart)->where('parent_id', $id)->where('quantity', '>=', $qty)->count()) {
                return 0;
            }
        }

        return $shipping_cost;
    }

    public function updatedShipping()
    {
        $this->shipping_cost = $this->shippingCost();

        $this->total = $this->subtotal + $this->shipping_cost;
    }

    public function cartUpdated()
    {
        $this->subtotal = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $this->updatedShipping();
        $this->emit('cartUpdated');
    }

    public function mount()
    {
        if ($user = auth('user')->user()) {
            $this->name = $user->name;
            $this->phone = $user->phone ?? '+880';
            $this->address = $user->address ?? '';
            $this->note = $user->note ?? '';
        }

        $this->cart = session()->get('cart', []);
        $this->cartUpdated();
    }

    public function checkout()
    {
        if (Str::startsWith($this->phone, '01')) {
            $this->phone = '+88' . $this->phone;
        }
        $data = $this->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+8801\d{9}$/',
            'address' => 'required',
            'note' => 'nullable',
            'shipping' => 'required',
        ]);

        if (count($this->cart) === 0) {
            throw ValidationException::withMessages(['products' => 'Your cart is empty.']);
        }

        $fraud = setting('fraud');

        if (Cache::has('fraud:hourly:' . request()->ip()) || Cache::has('fraud:daily:' . $data['phone'])) {
            if (Cache::get('fraud:hourly:' . request()->ip()) >= ($fraud->allow_per_hour ?? 3)) {
                abort(429, 'You have reached the maximum limit of orders per hour.');
            }
            if (Cache::get('fraud:daily:' . request()->ip()) >= ($fraud->allow_per_day ?? 7)) {
                abort(429, 'You have reached the maximum limit of orders per day.');
            }
        }

        $order = DB::transaction(function () use ($data, &$order) {
            $products = Product::find(array_keys($this->cart))
                ->map(function (Product $product) use ($data) {
                    $id = $product->id;
                    $quantity = $this->cart[$id]['quantity'];

                    if ($quantity <= 0) {
                        return null;
                    }
                    // Manage Stock
                    if ($product->should_track) {
                        if ($product->stock_count <= 0) {
                            // return null; // Allow overstock
                        }
                        $quantity = $product->stock_count >= $quantity ? $quantity : $product->stock_count;
                        $product->decrement('stock_count', $quantity);
                    }

                    // Needed Attributes
                    return [
                        'id' => $id,
                        'name' => $product->var_name,
                        'slug' => $product->slug,
                        'image' => $product->base_image->src,
                        'price' => $product->selling_price,
                        'quantity' => $quantity,
                        'category' => $product->category,
                        'total' => $quantity * $product->selling_price,
                    ];
                })->filter(function ($product) {
                    return $product != null; // Only Available Products
                })->toArray();

            $data['products'] = json_encode($products);
            $user = $this->getUser($data);
            $oldOrders = $user->orders()->get();
            $status = data_get(config('app.orders', []), 0, 'PENDING'); // Default Status

            $oldOrders = Order::select(['id', 'admin_id', 'status'])->where('phone', $data['phone'])->get();
            $adminIds = $oldOrders->pluck('admin_id')->unique()->toArray();
            $adminQ = Admin::where('role_id', Admin::SALESMAN)->where('is_active', true)->inRandomOrder();
            if (count($adminIds) > 0) {
                $data['admin_id'] = $adminQ->whereIn('id', $adminIds)->first()->id ?? $adminQ->first()->id ?? Admin::where('is_active', true)->inRandomOrder()->first()->id;
            } else {
                $data['admin_id'] = $adminQ->first()->id ?? Admin::where('is_active', true)->inRandomOrder()->first()->id;
            }

            $data += [
                'user_id' => $user->id, // If User Logged In
                'status' => $status,
                'status_at' => now()->toDateTimeString(),
                // Additional Data
                'data' => [
                    'is_fraud' => $oldOrders->whereIn('status', ['CANCELLED', 'RETURNED'])->count() > 0,
                    'is_repeat' => $oldOrders->count() > 0,
                    'shipping_area' => $data['shipping'],
                    'shipping_cost' => $this->shipping_cost,
                    'subtotal'      => is_array($products) ? array_reduce($products, function ($sum, $product) {
                        return $sum += $product['total'];
                    }, 0) : $products->sum('total'),
                ],
            ];

            // \LaravelFacebookPixel::createEvent('Purchase', ['currency' => 'USD', 'value' => data_get(json_decode($data['data'], true), 'subtotal')]);

            $order = Order::create($data);
            $user->notify(new OrderPlaced($order));

            GoogleTagManagerFacade::flash([
                'event' => 'purchase',
                'ecommerce' => [
                    'currency' => 'BDT',
                    'transaction_id' => $order->id,
                    'value' => $order->data->subtotal,
                    'items' => array_map(function ($product) {
                        return [
                            'item_id' => $product['id'],
                            'item_name' => $product['name'],
                            'item_category' => $product['category'],
                            'price' => $product['price'],
                            'quantity' => $product['quantity'],
                        ];
                    }, $products),
                ],
            ]);
    
            return $order;
        });

        Cache::put('fraud:hourly:' . request()->ip(), Cache::get('fraud:hourly:' . request()->ip(), 0) + 1, now()->addHour());
        Cache::put('fraud:daily:' . request()->ip(), Cache::get('fraud:daily:' . request()->ip(), 0) + 1, now()->addDay());

        // Undefined index email.
        // $data['email'] && Mail::to($data['email'])->queue(new OrderPlaced($order));

        session()->forget('cart');
        session()->flash('completed', 'Dear ' . $data['name'] . ', Your Order is Successfully Recieved. Thanks For Your Order.');

        return redirect()->route('track-order', [
            'order' => optional($order)->getKey(),
        ]);
    }

    private function getUser($data)
    {
        if ($user = auth('user')->user()) {
            return $user;
        }

        $user = User::query()->firstOrCreate(
            ['phone_number' => $data['phone']],
            array_merge(Arr::except($data, 'phone'), [
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
        return view('livewire.checkout', [
            'user' => optional(auth('user')->user()),
        ]);
    }
}
