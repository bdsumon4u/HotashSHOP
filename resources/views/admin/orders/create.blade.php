@extends('layouts.light.master')
@section('title', 'Create Order')

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
    <h3>Create Order</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.orders.index') }}">Orders</a>
    </li>
    <li class="breadcrumb-item">Create Order</li>
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="orders-table">
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header p-3"><strong>Create Order</strong></div>
                    <div class="card-body p-3">
                        <livewire:edit-order />
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
