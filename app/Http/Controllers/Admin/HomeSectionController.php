<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\HomeSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return $this->view([
            'categories' => Category::nested(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'order' => 'required',
            'categories' => 'required|array',
        ]);
        
        $homeSection = HomeSection::create($data);
        $homeSection->categories()->sync($data['categories']);

        return redirect()->route('admin.home-sections.index')->with('success', 'Section Has Been Created.');
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
        return $this->view([
            'section' => $homeSection,
            'categories' => Category::nested(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSection $homeSection)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'order' => 'required',
            'categories' => 'required|array',
        ]);
        
        $homeSection->update($data);
        $homeSection->categories()->sync($data['categories']);

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
        $homeSection->delete();

        return back()->withSuccess('Section Has Been Deleted.');
    }
}
