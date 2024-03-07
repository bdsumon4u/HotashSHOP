<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return DataTables::of($request->has('order') ? Product::whereNull('parent_id')->get() : Product::whereNull('parent_id')->latest('id'))
            ->addIndexColumn()
            ->addColumn('image', function (Product $product) {
                return '<img src="' . asset(optional($product->base_image)->src) . '" width="100" height="100" />';
            })
            ->editColumn('name', function (Product $product) {
                return '<a href="' . route('products.show', $product) . '" target="_blank">' . $product->name . '</a>';
            })
            ->addColumn('pricing', function (Product $product) {
                return $product->price == $product->selling_price
                    ? '<p>' . theMoney($product->price) . '</p>'
                    : '<del style="color: #ff0000;">' . theMoney($product->price) . '</del>
                        <br>
                    <ins style="text-decoration: none;">' . theMoney($product->selling_price) . '</ins>';
            })
            ->addColumn('stock', function (Product $product) {
                return $product->should_track
                    ? '<span class="text-' . ($product->stock_count ? 'success' : 'danger') . '">' . $product->stock_count . ' In Stock</span>'
                    : '<span class="text-success">In Stock</span>';
            })
            ->addColumn('actions', function (Product $product) {
                return '<div>
                    <a href="' . route('admin.products.edit', $product) . '" class="btn btn-block btn-primary">Edit</a>
                    <a href="' . route('admin.products.destroy', $product) . '" data-action="delete" class="btn btn-block btn-danger">Delete</a>
                </div>';
            })
            ->rawColumns(['image', 'name', 'pricing', 'stock', 'actions'])
            ->make(true);
    }
}
