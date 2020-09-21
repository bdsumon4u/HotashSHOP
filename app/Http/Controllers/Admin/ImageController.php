<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use ImageUploader;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view();
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

        return Image::create([
            'disk' => 'public',
            'filename' => $file->getClientOriginalName(),
            'path' => $this->uploadImage($file, [
                'width' => 700,
                'height' => 700,
                'dir' => 'images',
            ]),
            'extension' => $file->guessClientExtension(),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        if ($image->products->isNotEmpty()) {
            return back()->with('danger', 'Image Is Used.');
        }

        $this->delete();
    }
}
