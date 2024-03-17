<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\HomeSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSectionRequest;
use Illuminate\Support\Facades\DB;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        if (request()->has('orders')) {
            $orders = request('orders');
            DB::statement('UPDATE home_sections SET `order` = CASE id ' . implode(' ', array_map(function ($id) use ($orders) {
                return "WHEN $id THEN $orders[$id] ";
            }, array_keys($orders))) . 'END');

            cache()->put('homesections', HomeSection::orderBy('order', 'asc')->get());

            return response()->json(['message' => 'Sections Have Been Reordered.']);
        }
        return $this->view([
            'sections' => HomeSection::orderBy('order', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        return $this->view([
            'categories' => Category::nested(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HomeSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeSectionRequest $request)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        $data = $request->validationData();
        $homeSection = HomeSection::create($data);
        if (isset($data['categories'])) {
            $homeSection->categories()->sync($data['categories']);
        }
        cache()->put('homesections', HomeSection::orderBy('order', 'asc')->get());

        return redirect()->route('admin.home-sections.edit', $homeSection)->with('success', 'Section Has Been Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSection $homeSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSection $homeSection)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        return $this->view([
            'section' => $homeSection,
            'categories' => Category::nested(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HomeSectionRequest  $request
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function update(HomeSectionRequest $request, HomeSection $homeSection)
    {
        abort_if(request()->user()->is('salesman'), 403, 'You don\'t have permission.');
        $data = $request->validated();
        $homeSection->update($data);
        if (isset($data['categories'])) {
            $homeSection->categories()->sync($data['categories']);
        }
        cache()->put('homesections', HomeSection::orderBy('order', 'asc')->get());

        return redirect()->route('admin.home-sections.index')->with('success', 'Section Has Been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSection $homeSection)
    {
        abort_unless(request()->user()->is('admin'), 403, 'You don\'t have permission.');
        $homeSection->delete();

        return back()->withSuccess('Section Has Been Deleted.');
    }
}
