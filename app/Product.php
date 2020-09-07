<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $with = ['categories', 'brand', 'images'];

    protected $fillable = [
        'brand_id', 'name', 'slug', 'description', 'price', 'selling_price', 'sku', 'should_track', 'stock_count', 'is_active'
    ];

    public function getInStockAttribute()
    {
        return $this->track_stock
            ? $this->stock_count
            : true;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class)
            ->withPivot('img_type')
            ->withTimestamps();
    }

    public function getBaseImageAttribute()
    {
        return $this->images->first(function (Image $image) {
            return $image->pivot->img_type == 'base';
        });
    }

    public function getAdditionalImagesAttribute()
    {
        return $this->images->filter(function (Image $image) {
            return $image->pivot->img_type == 'additional';
        });
    }
}
