<?php

namespace App;

use App\Pathao\Facade\Pathao;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Symfony\Component\Routing\Matcher\Dumper\StaticPrefixCollection;

class Order extends Model
{
    use LogsActivity;

    const ONLINE = 0;
    const MANUAL = 1;

    protected $fillable = [
        'admin_id', 'user_id', 'type', 'name', 'phone', 'email', 'address', 'status', 'status_at', 'products', 'note', 'data',
    ];

    protected $attributes = [
        'status' => 'CONFIRMED',
        'data' => '{"subtotal":0,"shipping_cost":0,"advanced":0,"discount":0,"courier":"Other","city_id":"","area_id":"","weight":0.5}',
    ];

    protected static $logOnlyDirty = true;

    protected static $logFillable = true;

    protected static $logName = 'orders';

    protected static $submitEmptyLogs = false;

    protected static $ignoreChangedAttributes = ['status_at', 'updated_at'];

    protected static $logAttributesToIgnore = ['status_at', 'updated_at', 'data'];

    protected static $logAttributes = ['data->courier', 'data->advanced', 'data->discount', 'data->shipping_cost', 'data->subtotal'];

    public static function booted()
    {
        static::retrieved(function (Order $order) {
            if (empty($order->data['city_name'] ?? '') && !empty($order->data['city_id'] ?? '')) {
                $order->fill(['data' => ['city_name' => current(array_filter($order->getCityList(), fn ($c) => $c->city_id == $order->data['city_id']))->city_name ?? 'N/A']]);
                $order->fill(['data' => ['area_name' => current(array_filter($order->getAreaList(), fn ($a) => $a->zone_id == $order->data['area_id']))->zone_name ?? 'N/A']]);
                $order->save();
            }
        });

        static::saving(function (Order $order) {
            $order->adjustStock();

            if (!$order->isDirty('data')) return;

            $fuse = new \Fuse\Fuse([['area' => $order->address]], [
                'keys' => ['area'],
                'includeScore' => true,
                'includeMatches' => true,
            ]);
            # Problems:
            # 1. Dhaka, Tangail, Mirzapur.
            # 2. Mirjapur, Tangal, Dhaka.
            # 3. Somethingb. Bariasomething
            # 4. Brahmanbaria => Barishal

            if (false && empty($order->data['city_id'] ?? '')) {
                $matches = [];
                foreach ($order->getCityList() as $city) {
                    if ($match = $fuse->search($city->city_name)) {
                        $matches[$city->city_name] = $match[0]['score'];
                    }
                }
                if ($matches) {
                    asort($matches);
                    $city = current(array_filter($order->getCityList(), fn ($c) => $c->city_name === key($matches)));
                    $order->fill(['data' => ['city_id' => $city->city_id, 'city_name' => $city->city_name ?? 'N/A']]);
                }
            } else {
                $order->fill(['data' => ['city_name' => current(array_filter($order->getCityList(), fn ($c) => $c->city_id == $order->data['city_id']))->city_name ?? 'N/A']]);
            }

            if (false) {
                $matches = [];
                foreach ($order->getAreaList() as $area) {
                    if ($match = $fuse->search($area->zone_name)) {
                        $matches[$area->zone_name] = $match[0]['score'];
                    }
                }
                if ($matches) {
                    asort($matches);
                    $area = current(array_filter($order->getAreaList(), fn ($a) => $a->zone_name === key($matches)));
                    $order->fill(['data' => ['area_id' => $area->zone_id, 'area_name' => $area->zone_name ?? 'N/A']]);
                }
            } else {
                $order->fill(['data' => ['area_name' => current(array_filter($order->getAreaList(), fn ($a) => $a->zone_id == $order->data['area_id']))->zone_name ?? 'N/A']]);
            }
        });
    }

    public function adjustStock()
    {
        if ($this->exists && !$this->isDirty('status')) return;

        $increment = ['PENDING', 'WAITING', 'RETURNED', 'CANCELLED'];
        $decrement = ['CONFIRMED', 'INVOICED', 'SHIPPING', 'COMPLETED', 'LOST'];

        $prev = $this->getOriginal('status');
        $next = $this->getAttribute('status');

        // if both prev and next belongs to same group, then no need to adjust stock
        if (in_array($prev, $increment) && in_array($next, $increment)) return;
        if (in_array($prev, $decrement) && in_array($next, $decrement)) return;

        $fact = 1;
        if (in_array($next, $decrement)) {
            $fact = -1;
        }

        $DBproducts = Product::where('should_track', true)->find(array_keys($products = (array)$this->products));

        foreach ($DBproducts as $product) {
            $product->increment('stock_count', $fact * $products[$product->id]->quantity);
        }
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "The order #{$this->id} has been {$eventName}";
    }

    public function getProductsAttribute($products)
    {
        return json_decode($products);
    }

    public function getDataAttribute($data)
    {
        return json_decode($data, true);
    }

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = json_encode(array_merge($this->data, $data));
    }

    public function getBarcodeAttribute()
    {
        $pad = str_pad($this->id, 10, '0', STR_PAD_LEFT);

        return substr($pad, 0, 3) . '-' . substr($pad, 3, 3) . '-' . substr($pad, 6, 4);
    }

    public function getConditionAttribute()
    {
        return intval($this->data['subtotal']) + intval($this->data['shipping_cost']) - intval($this->data['advanced'] ?? 0) - intval($this->data['discount'] ?? 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault([
            'name' => 'System',
        ]);
    }

    public function getSubtotal($products)
    {
        $products = (array)$products;
        return array_reduce($products, function ($sum, $product) {
            return $sum + ((array)$product)['total'];
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['status_at', 'updated_at']);
    }

    public function getCityList()
    {
        $exception = false;
        $cityList = cache()->remember('pathao_cities', now()->addDay(), function () use (&$exception) {
            try {
                return Pathao::area()->city()->data;
            } catch (\Exception $e) {
                $exception = true;
                return [];
            }
        });

        if ($exception) cache()->forget('pathao_cities');

        return $cityList;
    }

    public function getAreaList()
    {
        $areaList = [];
        $exception = false;
        if ($this->data['city_id'] ?? false) {
            $areaList = cache()->remember('pathao_areas:' . $this->data['city_id'], now()->addDay(), function () use (&$exception) {
                try {
                    return Pathao::area()->zone($this->data['city_id'])->data;
                } catch (\Exception $e) {
                    $exception = true;
                    return [];
                }
            });
        }

        if ($exception) cache()->forget('pathao_areas:' . $this->data['city_id']);

        return $areaList;
    }
}
