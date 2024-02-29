<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        abort_if($request->user()->is('salesman'), 403, 'Not Allowed.');
        $attributes = collect($request->get('attributes'));
        $options = Option::find($attributes->flatten());

        DB::transaction(function () use ($attributes, $product, $options) {
            $product->variations()->delete();
            $variations = collect($attributes->first())->crossJoin(...$attributes->splice(1));

            $variations->each(function ($items, $i) use ($product, $options) {
                $name = $options->filter(fn ($item) => in_array($item->id, $items))->pluck('name')->join('-');
                $sku = $product->sku . '(' . implode('-', $items) . ')';
                $slug = $product->slug . '(' . implode('-', $items) . ')';
                if (!$variation = $product->variations()->firstWhere('sku', $sku)) {
                    $variation = $product->replicate();
                    $variation->forceFill([
                        'name' => $name,
                        'sku' => $sku,
                        'slug' => $slug,
                        'parent_id' => $product->id,
                    ]);
                    $variation->save();
                }
                $variation->options()->sync($items);
            });
        });

        return back()->withSuccess('Check your variations.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @param  \App\Product  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Product $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @param  \App\Product  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Product $variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @param  \App\Product  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Product $variation)
    {
        abort_if($request->user()->is('salesman'), 403, 'Not Allowed.');
        $variation->update($request->validate([
            'price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'should_track' => 'required|boolean',
            'stock_count' => 'nullable|numeric',
            'sku' => 'required|unique:products,sku,'.$variation->id,
        ]));

        // $query = "UPDATE products SET ";
        // foreach ($request->variations as $name => $variation) {
        //     $query .= "$name = CASE id ";
        //     foreach ($variation as $id => $value) {
        //         $query .= "WHEN $id THEN '{$value}' ";
        //     }
        //     $query .= "ELSE $name END, ";
        // }
        // $query = rtrim($query, ', ');

        // DB::statement($query);

        return back()->withSuccess('Variations updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @param  \App\Product  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Product $variation)
    {
        //
    }
}
