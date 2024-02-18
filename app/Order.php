<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use LogsActivity;

    protected $fillable = [
        'admin_id', 'user_id', 'name', 'phone', 'email', 'address', 'status', 'status_at', 'products', 'note', 'data',
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
        return json_decode($data);
    }

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = json_encode(array_merge((array)$this->data, $data));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['status_at', 'updated_at']);
    }
}
