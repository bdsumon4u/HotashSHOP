<?php

namespace App\Http\Controllers;

use App\HomeSection;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

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
        if ($request->search) {
            GoogleTagManagerFacade::set([
                'event' => 'search',
                'search_term' => $request->search,
            ]);
        } else {
            GoogleTagManagerFacade::set([
                'event' => 'page_view',
                'page_type' => 'shop',
            ]);
        }
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
            $products = $section->products($per_page);
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
        if ($product->parent_id) $product = $product->parent;
        $product->load(['brand', 'categories', 'variations.options']);
        $categories = $product->categories->pluck('id')->toArray();
        $products = Product::whereIsActive(1)
        ->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })
        ->whereNull('parent_id')
        ->where('id', '!=', $product->id)
        ->limit(config('services.products_count.related', 20))
        ->get();
        //  \LaravelFacebookPixel::createEvent('ViewContent', $parameters = []);
        GoogleTagManagerFacade::set([
            'event' => 'view_item',
            'ecommerce' => [
                'currency' => 'BDT',
                'value' => $product->selling_price,
                'items' => [
                    [
                        'item_id' => $product->id,
                        'item_name' => $product->name,
                        'price' => $product->selling_price,
                        'item_category' => $product->category,
                        'quantity' => 1,
                    ],
                ],
            ],
        ]);

        return $this->view(compact('product', 'products'));
    }
}
