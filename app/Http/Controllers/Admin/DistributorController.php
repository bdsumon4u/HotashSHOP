<?php

namespace App\Http\Controllers\Admin;

use App\Distributor;
use App\Http\Controllers\Controller;
use App\Traits\ImageUploader;
use Illuminate\Http\Request;

class DistributorController extends Controller
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
            'distributors' => Distributor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $data = $request->validate([
            'full_name' => 'required',
            'shop_name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'type' => 'required',
            'address' => 'required',
            'photo' => 'required|image|max:1024',
        ]);

        if (isset($data['photo']) && $data['photo']) {
            $data['photo'] = $this->uploadImage($data['photo'], [
                'dir' => 'distributors',
                'resize' => true,
                'width' => 460,
                'height' => 380,
            ]);
        }

        Distributor::create($data);

        return redirect()->action([static::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        return $this->view();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        $data = $request->validate([
            'full_name' => 'required',
            'shop_name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'type' => 'required',
            'address' => 'required',
            'photo' => 'nullable|image|max:1024',
        ]);

        if (isset($data['photo']) && $data['photo']) {
            $data['photo'] = $this->uploadImage($data['photo'], [
                'dir' => 'distributors',
                'resize' => true,
                'width' => 460,
                'height' => 380,
            ]);
        }

        $distributor->update($data);

        return redirect()->action([static::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();

        return redirect()->action([static::class, 'index']);
    }
}
