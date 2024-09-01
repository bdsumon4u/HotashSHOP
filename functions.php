<?php

use App\Brand;
use App\Category;
use App\Image;
use App\Page;
use App\Product;
use App\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if (! function_exists('categories')) {
    function categories($parent = -1) {
        return Category::with('image')
        ->inRandomOrder()
        ->when($parent != -1, function ($query) use ($parent) {
            return is_null($parent)
                ? $query->whereNull('parent_id')
                : $query->where('parent_id', $parent);
        })
        ->get()
        ->map(function ($category) {
            if (!$image = $category->image) {
                $image = Image::whereHas('products.categories', function ($query) use ($category) {
                    $query->where('category_id', $category->id);
                })->inRandomOrder()->first();
            }
            $category->image_src = asset($image->path ?? 'https://placehold.co/600x600?text=No+Product');
            return $category;
        });
    }
}

if (! function_exists('brands')) {
    function brands() {
        return Brand::with('image')
        ->inRandomOrder()
        ->get()
        ->map(function ($brand) {
            if (!$image = $brand->image) {
                $image = Image::whereHas('products.brand', function ($query) use ($brand) {
                    $query->where('brand_id', $brand->id);
                })->inRandomOrder()->first();
            }
            $brand->image_src = asset($image->path ?? 'https://placehold.co/600x600?text=No+Product');
            return $brand;
        });
    }
}

if (! function_exists('pageRoutes')) {
    function pageRoutes() {
        try {
            Schema::hasTable((new Page)->getTable())
                && Route::get('{page:slug}', 'PageController')
                    ->where('page', 'test-page|'.implode(
                        '|', Page::get('slug')
                            ->map->slug
                            ->toArray()
                    ))
                    ->middleware('shortkode')
                    ->name('page');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

if (! function_exists('setting')) {
    function setting($name) {
        return cache()->rememberForever('settings:'.$name, function () use ($name) {
            return optional(Setting::whereName($name)->first())->value;
        });
    }
}

if (! function_exists('theMoney')) {
    function theMoney($amount, $decimals = null, $currency = "TK") {
        return $currency."&nbsp;<span>".number_format($amount, $decimals)."</span>";
    }
}

function bytesToHuman($bytes) {
    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}

function hasErr($errors, $params) {
    foreach (explode('|', $params) as $param)
        if ($errors->has($param))
            return true;
    return false;
}

function genSKU($repeat = 5, $length = null) {
    $sku = null;
    $length = $length ?: mt_rand(6, 10);
    $charset = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $multiplier = ceil($length / strlen($charset));
    // Generate SKU
    if (--$repeat) {
        $sku = substr(str_shuffle(str_repeat($charset, $multiplier)), 1, $length);
        Product::where('sku', $sku)->count() && genSKU($repeat);
    }
    return $sku;
}
