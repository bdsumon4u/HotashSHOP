<?php

namespace App\Http\Controllers;

use App\Product;
use App\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = 3;
        $cols = 5;
        if ($productsPage = Setting::whereName('products_page')->first()) {
            $rows = $productsPage->value->rows;
            $cols = $productsPage->value->cols;
        }
        $per_page = $request->get('per_page', $rows * $cols);
        $products = Product::whereIsActive(1)
            ->when($request->search, function ($query) use ($request) {
                $query->search($request->search, null, true);
            })
            ->latest('id')
            ->paginate($per_page)->appends(request()->query());
        return $this->view(compact('products', 'per_page', 'rows', 'cols'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = $product->categories->pluck('id')->toArray();
        $products = Product::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })->where('id', '!=', $product->id)->limit(20)->get();
        return $this->view(compact('products'));
    }
}
