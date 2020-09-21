<?php

namespace App\Http\Controllers;

use App\Product;
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
        $per_page = $request->get('per_page', 15);
        $products = Product::whereIsActive(1)
            ->when($request->search, function ($query) use ($request) {
                $query->search($request->search, null, true);
            })
            ->latest('id')
            ->paginate($per_page)->appends(request()->query());
        return $this->view([
            'products' => $products,
            'per_page' => $per_page,
        ]);
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
