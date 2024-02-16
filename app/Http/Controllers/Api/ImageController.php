<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<a href="' . route('admin.images.destroy', $image) . '" data-action="delete" class="btn btn-danger">Delete</a>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<button class="select-image p-1 d-flex justify-content-center align-items-center text-dark" data-id="' . $image->id . '" data-src="' . asset($image->path) . '">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </button>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<button class="select-image p-1 d-flex justify-content-center align-items-center text-dark" data-id="' . $image->id . '" data-src="' . asset($image->path) . '">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </button>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    protected function ready()
    {
        return DataTables::of(request()->has('order') ? Image::all() : Image::latest('id'))
            ->addIndexColumn()
            ->addColumn('preview', function (Image $image) {
                return '<img src="' . asset($image->path) . '" width="100" height="120" />';
            });
    }
}
