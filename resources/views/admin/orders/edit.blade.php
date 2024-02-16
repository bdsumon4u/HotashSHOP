@extends('layouts.light.master')
@section('title', 'Edit Order')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@push('styles')
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@section('breadcrumb-title')
    <h3>Edit Order</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.orders.index') }}">Orders</a>
    </li>
    <li class="breadcrumb-item">Edit Order</li>
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="orders-table">
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header p-3"><strong>Edit Order</strong></div>
                    <div class="card-body p-3">
                        <x-form :action="route('admin.orders.update', $order)" method="PATCH">
                            @php $data = $order->data @endphp
                            <div class="row">
                                <div class="col-12 col-lg-6 col-xl-7">
                                    <div class="card mb-lg-0">
                                        <div class="card-body p-3">
                                            <h3 class="card-title">Billing details</h3>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <x-label for="name">Name</x-label> <span
                                                        class="text-danger">*</span>
                                                    <x-input name="name" placeholder="Type your name here"
                                                        :value="$order->name" />
                                                    <x-error field="name" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-label for="phone">Phone</x-label> <span
                                                        class="text-danger">*</span>
                                                    <x-input name="phone" placeholder="Type your phone number here"
                                                        :value="$order->phone ?? '+880'" />
                                                    <x-error field="phone" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <x-label for="email">Email Address</x-label>
                                                    <x-input type="email" name="email" placeholder="Email Address"
                                                        :value="$order->email" />
                                                    <x-error field="email" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block">Shipping City <span
                                                        class="text-danger">*</span></label>
                                                @php $dcharge = setting('delivery_charge') @endphp
                                                <div class="form-control @error('shipping') is-invalid @enderror">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="inside-dhaka"
                                                            name="shipping" value="Inside Dhaka"
                                                            data-val="{{ $dcharge->inside_dhaka ?? config('services.shipping.Inside Dhaka') }}"
                                                            {{ $data->shipping_area == 'Inside Dhaka' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="inside-dhaka">Inside
                                                            Dhaka</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input"
                                                            id="outside-dhaka" name="shipping" value="Outside Dhaka"
                                                            data-val="{{ $dcharge->outside_dhaka ?? config('services.shipping.Outside Dhaka') }}"
                                                            {{ $data->shipping_area == 'Outside Dhaka' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="outside-dhaka">Outside
                                                            Dhaka</label>
                                                    </div>
                                                </div>
                                                <x-error field="shipping" />
                                            </div>
                                            <div class="form-group">
                                                <x-label for="address">Address</x-label> <span class="text-danger">*</span>
                                                <x-input name="address" :value="$order->address"
                                                    placeholder="Enter Correct Address" />
                                                <x-error field="address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block">Courier <span class="text-danger">*</span></label>
                                                @php($courier = $data->courier ?? '')
                                                <div class="form-control @error('data.courier') is-invalid @enderror">
                                                    @foreach (['Pathao', 'SteadFast', 'Manual'] as $provider)
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                id="{{ $provider }}" name="data[courier]"
                                                                value="{{ $provider }}"
                                                                {{ $courier == $provider ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="{{ $provider }}">{{ $provider }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <x-error field="data[courier]" />
                                            </div>
                                            <div Pathao class="form-row @if ($courier != 'Pathao') d-none @endif">
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" selector name="data[city_id]">
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->city_id }}"
                                                                @if ($city->city_id == ($data->city_id ?? false)) selected @endif>
                                                                {{ $city->city_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-error field="data[city_id]" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" selector name="data[area_id]">
                                                        <option value="">Select Area</option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{ $area->zone_id }}"
                                                                @if ($area->zone_id == ($data->area_id ?? false)) selected @endif>
                                                                {{ $area->zone_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-error field="data[area_id]" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-divider"></div>
                                        <div class="card-body p-3">
                                            <h3 class="card-title">Ordered Products</h3>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <input type="text" name="id_or_sku" id="id-or-sku"
                                                        placeholder="ID or SKU" class="form-control">
                                                    <input type="text" name="new_quantity" id="new-quantity"
                                                        placeholder="Quantity" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-primary"
                                                    formaction="{{ route('admin.orders.add-product', $order) }}">Add
                                                    New</button>
                                            </div>
                                            <div class="table-responsive my-2">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ $product->image }}" width="100"
                                                                        height="100" alt="">
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        name="quantity[{{ $product->id }}]"
                                                                        id="quantity-{{ $product->id }}"
                                                                        value="{{ old('quantity.' . $product->id, $product->quantity) }}">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button class="btn btn-success ml-auto d-block" type="submit"
                                                formaction="{{ route('admin.orders.update-quantity', $order) }}">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h3 class="card-title">Your Order</h3>

                                            <label for="status">Order Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $status == $order->status ? 'selected' : '' }}>
                                                        {{ $status }}</option>
                                                @endforeach
                                            </select>

                                            <table class="checkout__totals table table-borderless">
                                                <tbody class="checkout__totals-subtotals">
                                                    <tr>
                                                        <th>Subtotal</th>
                                                        <td class="checkout-subtotal">{!! theMoney($data->subtotal) !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping</th>
                                                        <td class="shipping">
                                                            <input class="shipping"
                                                                style="height: auto; padding: 2px 8px;" type="text"
                                                                name="data[shipping_cost]" value="{!! $data->shipping_cost ?? 0 !!}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot class="checkout__totals-footer">
                                                    {{--                                            <tr> --}}
                                                    {{--                                                <th>Total</th> --}}
                                                    {{--                                                <td>{!!  theMoney($data->shipping_cost + $data->subtotal)  !!}</td> --}}
                                                    {{--                                            </tr> --}}
                                                    <tr>
                                                        <th>Advanced</th>
                                                        <td>
                                                            <input style="height: auto; padding: 2px 8px;" type="text"
                                                                name="data[advanced]" value="{!! $data->advanced ?? 0 !!}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td>
                                                            <input style="height: auto; padding: 2px 8px;" type="text"
                                                                name="data[discount]" value="{!! $data->discount ?? 0 !!}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <!--<tr>-->
                                                    <!--    <th>Payable</th>-->
                                                    <!--    <td class="shipping">{!! theMoney(
                                                        $order->data->shipping_cost +
                                                            $order->data->subtotal -
                                                            ($order->data->advanced ?? 0) -
                                                            ($order->data->discount ?? 0),
                                                    ) !!}</td>-->
                                                    <!--</tr>-->
                                                    <tr>
                                                        <th>Note <small>(Optional)</small></th>
                                                        <td>
                                                            <div class="form-group">
                                                                <x-textarea name="note" rows="4">{{ $order->note }}</x-textarea>
                                                                <x-error field="note" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <button type="submit"
                                                class="btn btn-primary btn-xl btn-block">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-form>
                    </div>
                    <div class="card-footer rounded-0">
                        <h5 class="text-center">Other Orders</h5>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Product</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a class="btn btn-light btn-sm text-nowrap px-2" target="_blank" href="{{ route('admin.orders.edit', $order) }}">{{ $order->id }} <i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        @foreach ($order->products as $product)
                                            <div>{{ $product->quantity }} x {{ $product->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->note }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('[selector]').select2({
                // tags: true,
            });

            $(document).on('change', '[name="data[courier]"]', function(ev) {
                if (ev.target.value == 'Pathao') {
                    $('[Pathao]').removeClass('d-none');
                } else {
                    $('[Pathao]').addClass('d-none');
                }
            });

            $(document).on('change', '[name="data[city_id]"]', function(ev) {
                $('[name="data[area_id]"]').empty();
                $.get('/api/areas/' + ev.target.value, function(data) {
                    data = data.map(function(area) {
                        return {
                            id: area.zone_id,
                            text: area.zone_name,
                        };
                    });

                    data.unshift({
                        id: '',
                        text: 'Select Area',
                    });

                    $('[name="data[area_id]"]').select2({
                        data
                    });
                })
            });
        });
    </script>
@endpush
