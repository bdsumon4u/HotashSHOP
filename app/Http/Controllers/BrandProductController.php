<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

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
        $per_page = $request->get('per_page', 50);
        $sorted = setting('show_option')->product_sort ?? 'random';
        $products = $brand->products()->whereIsActive(1);
        if ($sorted == 'random') {
            $products->inRandomOrder();
        } else if ($sorted == 'updated_at') {
            $products->latest('updated_at');
        } else if ($sorted == 'selling_price') {
            $products->orderBy('selling_price');
        }
        $products = $products->paginate($per_page)->appends(request()->query());
        return view('products.index', [
            'products' => $products,
            'per_page' => $per_page,
        ]);
    }
}
