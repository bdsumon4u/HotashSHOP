<?php

namespace App;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $with = ['categories', 'brand', 'images'];

    protected $fillable = [
        'brand_id', 'name', 'slug', 'description', 'price', 'selling_price', 'sku', 'should_track', 'stock_count', 'is_active'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($product) {
            if ($product->categories->isEmpty() || $product->images->isEmpty()) {
                $categories = range(1, 30);
                $categories = array_map(function ($key) use ($categories) {
                    return $categories[$key];
                }, array_rand($categories, mt_rand(4, 7)));

                $additionals = range(1, 30);
                $additionals = array_map(function ($key) use ($additionals) {
                    return $additionals[$key];
                }, array_rand($additionals, mt_rand(4, 7)));

                ProductCreated::dispatch($product, [
                    'categories' => $categories,
                    'base_image' => mt_rand(1, 23),
                    'additional_images' => $additionals,
                ]);
            };
        });
    }

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
