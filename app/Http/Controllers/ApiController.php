<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiController extends Controller
{
    public function categories()
    {
        return view('categories', [
            'categories' => Category::inRandomOrder()->get(),
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

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return back()->with('success', 'Cache has been cleared');
    }
}
