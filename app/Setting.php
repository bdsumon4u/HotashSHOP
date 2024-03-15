<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'name', 'value',
    ];

    public static function booted()
    {
        static::saved(function ($setting) {
            Cache::put('settings:'.$setting->name, $setting);
            Cache::forget('settings');
        });
    }

    public static function array()
    {
        return Cache::rememberForever('settings', function () {
            return self::all()->flatMap(function ($setting) {
                return [$setting->name => $setting->value];
            })->toArray();
        });
    }

    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $value = json_encode(array_merge((array)$this->value, $value));
        }

        $this->attributes['value'] = $value;
    }

    public function getValueAttribute($value)
    {
        return json_decode($value);
    }
}
