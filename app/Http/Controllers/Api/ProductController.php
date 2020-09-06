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
        return DataTables::of(Product::all())
            ->addIndexColumn()
            ->addColumn('actions', function (Product $product) {
                return '<div>
                    <a href="'.route('admin.products.edit', $product).'" class="btn btn-block btn-primary">Edit</a>
                    <a href="'.route('admin.products.destroy', $product).'" data-action="delete" class="btn btn-block btn-danger">Delete</a>
                </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
