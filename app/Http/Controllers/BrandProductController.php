<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use WebLAgence\LaravelFacebookPixel\LaravelFacebookPixel;

class BrandProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Brand $brand)
    {
        LaravelFacebookPixel::createEvent('Looking For Brand', [
            'Brand Name' => $brand->name,
        ]);
        $per_page = $request->get('per_page', 15);
        $products = $brand->products()
            ->whereIsActive(1)
            ->latest('id')
            ->paginate($per_page)->appends(request()->query());
        return view('products.index', [
            'products' => $products,
            'per_page' => $per_page,
        ]);
    }
}
