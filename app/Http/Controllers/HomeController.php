<?php

namespace App\Http\Controllers;

use App\Category;
use App\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $categories = Category::nested(11);
        $slides = Slide::whereIsActive(1)->get();
        // dd($categories);
        return view('index', compact('slides', 'categories'));
    }
}
