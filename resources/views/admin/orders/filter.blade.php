@extends('layouts.light.master')
@section('title', 'Reports')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterange-picker.css')}}">
<style>
    .daterangepicker {
        border: 2px solid #d7d7d7 !important;
    }
</style>
@endpush

@section('breadcrumb-title')
<h3>Reports</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Reports</li>
@endsection

@push('styles')
<style>
@media print {
    html, body {
        /* height:100vh; */
        margin: 0 !important;
        padding: 0 !important;
        /* overflow: hidden; */
    }
    .main-nav {
        display: none !important;
        width: 0 !important;
    }
    .page-body {
        font-size: 20px;
        margin-top: 0 !important;
        margin-left: 0 !important;
    }
    .page-break {
        page-break-after: always;
        border-top: 2px dashed #000;
    }
}
</style>
@endpush

@section('content')
<div class="row mb-5">
    <div class="col-md-8 mx-auto">
        <div class="reports-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header p-3">
                    <form action="">
                        <div class="row">
                            <div class="col-auto pr-1">
                                <select name="date_type" id="datetype" class="form-control">
                                    <option value="created_at" @if(request('date_type') == 'created_at') selected @endif>CREATED</option>
                                    <option value="status_at" @if(request('date_type') == 'status_at') selected @endif>UPDATED</option>
                                </select>
                            </div>
                            <div class="col-auto px-1">
                                <input class="form-control" id="reportrange" type="text">
                                <input type="hidden" name="start_d" value="{{ $start }}">
                                <input type="hidden" name="end_d" value="{{ $end }}">
                            </div>
                            <div class="col-auto px-1">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Delivery Status</option>
                                    @foreach(config('app.orders', []) as $status)
                                    <option value="{{ $status }}" @if(request()->get('status') == $status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto px-1">
                                <select name="staff_id" id="staff-id" class="form-control">
                                    <option value="">Select Staff</option>
                                    @foreach(\App\Admin::where('role_id', 1)->get() as $admin)
                                    <option value="{{ $admin->id }}" @if(request()->get('staff_id') == $admin->id) selected @endif>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col pl-1">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="min-width: 120px;">Name</th>
                                    <th style="min-width: 100px;">Quantity</th>
                                </tr>
                            </thead>
                            @php $total = 0 @endphp
                            <tbody>
                                @foreach ($products as $name => $quantity)
                                    @php $total += $quantity @endphp
                                    <tr>
                                        <td>{{ $name }}</td>
                                        <td>{{ $quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Total</th>
                                <th>{{ $total }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/datepicker/daterange-picker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js') }}"></script>
    <script>
        window._start = moment('{{ $start }}');
        window._end = moment('{{ $end }}');
        window.reportRangeCB = function (start, end) {
            $('input[name="start_d"]').val(start.format('YYYY-MM-DD'));
            $('input[name="end_d"]').val(end.format('YYYY-MM-DD'));
        }
    </script>
@endpush
