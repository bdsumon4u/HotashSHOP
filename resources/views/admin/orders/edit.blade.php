@extends('layouts.light.master')
@section('title', 'Edit Order')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
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
                                    <div class="card rounded-0 shadow-sm">
                                        <div class="card-header p-3">
                                            <h5 class="card-title">Billing details</h5>
                                        </div>
                                        <div class="card-body p-3">
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
                                    </div>
                                    <livewire:order-product-manager :order="$order" />
                                </div>
                                <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                                    <div class="card rounded-0 shadow-sm">
                                        <div class="card-header p-3">
                                            <h5 class="card-title">Your Order</h5>
                                        </div>
                                        <div class="card-body p-3">
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
                                    <?php
                                        function getData($data) {
                                            if (isset($data['data'])) {
                                                $data = array_merge($data, $data['data']);
                                                unset($data['data']);
                                            }
                                            return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                                        }
                                    ?>
                                    <div class="card rounded-0 shadow-sm">
                                        <div class="card-header p-3">
                                            <h5 class="card-title">Activities</h5>
                                        </div>
                                        <div class="card-body p-3">
                                            {{-- Accordion --}}
                                            <div id="accordion">
                                                @foreach($order->activities()->latest()->get() as $activity)
                                                    <div class="card rounded-0 shadow-sm mb-1">
                                                        <div class="card-header px-3 py-2" id="heading{{ $activity->id }}">
                                                            <a class="text-dark" data-toggle="collapse" href="#collapse-{{$activity->id}}">
                                                                <div class="border-bottom pb-1 mb-1 text-primary">{{ $activity->description }}</div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div><i class="fa fa-user mr-1"></i>{{ $activity->causer->name ?? 'System' }}</div>
                                                                    <div><i class="fa fa-clock-o mr-1"></i>{{ $activity->created_at->format('d-M-Y h:i A') }}</div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div id="collapse-{{$activity->id}}" class="collapse" data-parent="#accordion">
                                                            <div class="card-body p-3">
                                                                <table class="table table-responsive">
                                                                    <tbody>
                                                                        @if($activity->changes['old'] ?? false)
                                                                        <tr>
                                                                            <th class="text-center">OLD</th>
                                                                            <th class="text-center">NEW</th>
                                                                        </tr>
                                                                        @endif
                                                                        <tr>
                                                                            @if($activity->changes['old'] ?? false)
                                                                            <td>
                                                                                <pre><div class="language-php">{{ getData($activity->changes['old'] ?? []) }}</div></pre>
                                                                            </td>
                                                                            @endif
                                                                            <td>
                                                                                <pre><div class="language-php">{{ getData($activity->changes['attributes']) }}</div></pre>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
                <div class="card rounded-0 shadow-sm">

                    <div class="card-header p-3">
                        <h5 class="text-center">Other Orders</h5>
                    </div>
                    <div class="card-footer rounded-0 p-3">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Courier</th>
                                    <th>Staff</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a class="btn btn-light btn-sm text-nowrap px-2" target="_blank" href="{{ route('admin.orders.edit', $order) }}">{{ $order->id }} <i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        @foreach ($order->products as $product)
                                            <div>{{ $product->quantity }} x {{ $product->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->data->subtotal + $order->data->shipping_cost - ($order->data->advanced ?? 0) - ($order->data->discount ?? 0) }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->courier }}</td>
                                    <td>{{ $order->admin->name }}</td>
                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
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
    <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
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
