<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->view();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return $this->view([
            'statuses' => config('app.orders', [])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^\+8801\d{9}$/',
            'email' => 'nullable',
            'address' => 'required',
            'note' => 'nullable',
            'status' => 'required',
        ]);

        $order->update($data);
        return redirect(route('admin.orders.show', $order))->withSuccess('Order Has Been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return $this->delete();
    }
}
