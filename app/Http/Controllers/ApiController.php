<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiController extends Controller
{
    public function categories()
    {
        return view('categories', [
            'categories' => Category::with('image')
                ->inRandomOrder()
                ->get()
                ->map(function ($category) {
                    if (!$image = $category->image) {
                        $image = Image::whereHas('products.categories', function ($query) use ($category) {
                            $query->where('category_id', $category->id);
                        })->inRandomOrder()->first();
                    }
                    $category->image_src = asset($image->path ?? 'https://placehold.co/600x600?text=No+Product');
                    return $category;
                }),
        ]);
    }

    public function storageLink()
    {
        return Artisan::call('storage:link');
    }

    public function scoutFlush()
    {
        return Artisan::call('scout:flush', ["model" => "App\Product"]);
    }

    public function scoutImport()
    {
        return Artisan::call('scout:import', ["model" => "App\Product"]);
    }

    public function linkOptimize()
    {
        Artisan::call('storage:link');
        Artisan::call('optimize:clear');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return back()->with('success', 'Cache has been cleared');
    }
}