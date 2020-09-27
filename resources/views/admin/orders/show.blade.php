@extends('layouts.light.master')
@section('title', 'Invoice')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/print.css')}}">
@endpush

@push('styles')
<style>
@media print {
    html, body {
    height:100vh; 
    margin: 0 !important; 
    padding: 0 !important;
    overflow: hidden;
    }

    .main-nav {
        display: none !important;
        width: 0 !important;
    }

    .print-edit-buttons,
    .footer {
        display: none !important;
    }

    .page-body {
        margin-left: 0 !important;
        page-break-after: always;
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
                                            <img class="media-object" src="{{asset($logo->mobile)}}" alt="" width="180" height="54">
                                        </div>
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading">{{ $company->name }}</h4>
                                            <p>{{ $company->email }}<br><span class="digits">{{ $company->phone }}</span></p>
                                        </div>
                                    </div>
                                    <!-- End Info-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-md-right">
                                        <h3>Invoice #<span class="digits counter">{{ $order->id }}</span></h3>
                                        <p>
                                            Ordered At: {{ $order->created_at->format('M') }}<span class="digits"> {{ $order->created_at->format('d, Y') }}</span>
                                            <br> Invoiced At: {{ date('M') }}<span class="digits"> {{ date('d, Y') }}</span>
                                        </p>
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
                                            <th width="100">Image</th>
                                            <th>Name</th>
                                            <th width="95">Price</th>
                                            <th width="10">Quantity</th>
                                            <th width="95">Total</th>
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
                    <div class="col-sm-12 print-edit-buttons text-center mt-3">
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