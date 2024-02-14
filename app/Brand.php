<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    public static function booted()
    {
        static::saved(function () {
            cache()->forget('brands');
        });

        static::deleting(function () {
            cache()->forget('brands');
        });
    }

    public static function cached()
    {
        return cache()->rememberForever('brands', function () {
            return Brand::all();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class)
            ->whereNull('parent_id');
    }
}
