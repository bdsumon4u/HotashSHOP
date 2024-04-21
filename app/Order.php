<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

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
}
