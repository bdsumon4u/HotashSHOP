<?php

namespace App\Http\Controllers\Admin;

use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploader;

class SlideController extends Controller
{
    use ImageUploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view([
            'slides' => Slide::all(),
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
        $request->validate([
            'file' => 'required|image',
        ]);

        $file = $request->file('file');
        return Slide::create([
            'mobile_src' => $this->uploadImage($file, [
                'width' => 510,
                'height' => 300,
                'dir' => 'slides/mobile',
            ]),
            'desktop_src' => $this->uploadImage($file, [
                'width' => 840,
                'height' => 395,
                'dir' => 'slides/desktop',
            ]),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return $this->view(compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'title' => 'nullable|max:255',
            'text' => 'nullable|max:255',
            'btn_name' => 'nullable|max:20',
            'btn_href' => 'nullable|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $slide->update($data);

        return back()->with('success', 'Slide Has Been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return back()->with('success', 'Slide Has Been Deleted.');
    }
}
