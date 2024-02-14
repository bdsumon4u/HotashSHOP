<?php

namespace App\Http\Controllers;

use App\HomeSection;
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
       // \LaravelFacebookPixel::createEvent('PageView', $parameters = []);
        $section = null;
        $rows = 3;
        $cols = 5;
        if ($productsPage = Setting::whereName('products_page')->first()) {
            $rows = $productsPage->value->rows;
            $cols = $productsPage->value->cols;
        }
        $per_page = $request->get('per_page', $rows * $cols);
        if ($section = request('section', 0)) {
            $section = HomeSection::with('categories')->findOrFail($section);
            $products = $section->products(false, $per_page);
        } else {
            $products = Product::whereIsActive(1)
                ->whereNull('parent_id')
                ->when($request->search, function ($query) use ($request) {
                    $query->search($request->search, null, true);
                })
                ->latest('id')
                ->paginate($per_page);
        }
        $products = $products
            ->appends(request()->query());
        return $this->view(compact('products', 'per_page', 'rows', 'cols', 'section'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $selectedVar = $product;
        if ($product->parent_id) {
            $selectedVar = $product;
            $product = $product->parent;
        } else if ($product->variations->isNotEmpty()) {
            $selectedVar = $product->variations->random();
        }

        if (request()->has('options')) {
            $variation = $product->variations->first(function ($item) {
                return $item->options->pluck('id')->diff(request('options'))->isEmpty();
            });
            if ($variation) {
                $selectedVar = $variation;
            }
        }

        $dataId = $selectedVar->id;
        $dataMax = $selectedVar->should_track ? $selectedVar->stock_count : -1;

        $optionGroup = $product->variations->pluck('options')->flatten()->unique('id')->groupBy('attribute_id');
        $attributes = \App\Attribute::find($optionGroup->keys());

        $product->load(['brand', 'categories', 'variations.options']);
        $categories = $product->categories->pluck('id')->toArray();
        $products = Product::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })
        ->whereNull('parent_id')
        ->where('id', '!=', $product->id)
        ->limit(config('services.products_count.related', 20))
        ->get();
        //  \LaravelFacebookPixel::createEvent('ViewContent', $parameters = []);

        if (request()->has('options')) {
            return compact('dataId', 'dataMax') + ['content' => view('products.info', compact('product', 'products', 'optionGroup', 'selectedVar', 'attributes'))->render()];
        }

        return $this->view(compact('dataId', 'dataMax', 'product', 'products', 'optionGroup', 'selectedVar', 'attributes'));
    }
}
