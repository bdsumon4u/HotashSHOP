@extends('layouts.light.master')
@section('title', 'Invoice')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/print.css')}}">
@endpush

@push('styles')
<style>
@media print {
    .main-nav
    .buttons {
        display: none !important;
        width: 0 !important;
    }

    .page-body {
        margin-left: 0 !important;
    }
}
</style>
@endpush

@section('breadcrumb-title')
<h3>Invoice</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.orders.index') }}">Orders</a>
</li>
<li class="breadcrumb-item">Invoice</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object img-60" src="{{asset('assets/images/other-images/logo-login.png')}}" alt="">
                                        </div>
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading">Cuba</h4>
                                            <p>hello@Cuba.in<br><span class="digits">289-335-6503</span></p>
                                        </div>
                                    </div>
                                    <!-- End Info-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-md-right">
                                        <h3>Invoice #<span class="digits counter">{{ $order->id }}</span></h3>
                                        <p>Issued: May<span class="digits"> 27, 2015</span><br> Payment Due: June
                                            <span class="digits">27, 2015</span></p>
                                    </div>
                                    <!-- End Title-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-body m-l-20">
                                        <h4 class="media-heading">{{ $order->name }}</h4>
                                        <p><span class="digits">{{ $order->email }}</span><br>{{ $order->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="text-md-right" id="project">
                                    <h6>Note</h6>
                                    <p>{{ $order->note ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Invoice Mid-->
                        <div>
                            <div class="table-responsive invoice-table" id="table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Image</td>
                                            <td>Name</td>
                                            <td>Price</td>
                                            <td>Quantity</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ $product->image }}" width="100" height="100" alt="">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->quantity * $product->price }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="4">Subtotal</th>
                                            <th>{{ $order->data->subtotal }}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">Shipping</th>
                                            <th>{{ $order->data->shipping_cost }}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">Total</th>
                                            <th>{{ $order->data->shipping_cost + $order->data->subtotal }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table-->
                        </div>
                        <!-- End InvoiceBot-->
                    </div>
                    <div class="col-sm-12 buttons text-center mt-3">
                        <button class="btn btn btn-primary mr-2" type="button" onclick="myFunction()">Print</button>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-success">Edit</a>
                    </div>
                    <!-- End Invoice-->
                    <!-- End Invoice Holder-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/print.js')}}"></script>
@endpush