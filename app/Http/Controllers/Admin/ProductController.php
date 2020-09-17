<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Product;
use App\Category;
use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view([
            'categories' => Category::nested(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['brand_id']    = $data['brand'];
        $data['stock_count'] = intval($data['stock_count']);

        event(new ProductCreated(Product::create($data), $data));

        return back()->with('success', 'Product Has Been Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return $this->view(compact('product'), '', [
            'categories' => Category::nested(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['brand_id']    = $data['brand'];
        $data['stock_count'] = intval($data['stock_count']);

        $product->update($data);
        event(new ProductUpdated($product, $data));

        return back()->with('success', 'Product Has Been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return request()->ajax()
            ? true
            : back()->with('success', 'Product Has Been Deleted.');
    }
}
