<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        return $this->view([
            'categories' => Category::nested(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        if ($request->has('categories')) {
            $data = $request->validate([
                'categories' => 'required|array',
            ]);

            collect($data['categories'])
                ->each(function ($data) {
                    Category::find($data['id'])->update($data);
                });

            cache()->forget('categories:nested');
            return true;
        }
        $data = $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
            'base_image' => 'nullable|integer',
        ]);

        $data['image_id'] = Arr::pull($data, 'base_image');

        Category::create($data);

        return back()->with('success', 'Category Has Been Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        $data = $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|unique:categories,id,' . $category->id,
            'slug' => 'required|unique:categories,id,' . $category->id,
            'base_image' => 'nullable|integer',
        ]);

        $data['image_id'] = Arr::pull($data, 'base_image');

        $category->update($data);

        return back()->with('success', 'Category Has Been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_unless(request()->user()->is('admin'), 403, 'You don\'t have permission.');
        DB::transaction(function () use ($category) {
            $category->childrens()->delete();
            $category->delete();
        });
        return redirect()->route('admin.categories.index')->with('success', 'Category Has Been Deleted.');
    }
}
