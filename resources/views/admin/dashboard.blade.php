@extends('layouts.light.master')
@section('title', 'Ecommerce')

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
<h3>Ecommerce</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
@endsection

@section('breadcrumb-right')
    <div class="theme-form m-t-10">
        <div style="max-width: 600px; margin-right: auto;">
            <div class="input-group">
               <select name="date_type" id="datetype" class="form-control input-group-prepend" style="max-width: 150px;">
                  <option value="created_at" @if(request('date_type') == 'created_at') selected @endif>CREATED</option>
                  <option value="status_at" @if(request('date_type') == 'status_at') selected @endif>UPDATED</option>
               </select>
               <input class="form-control" id="reportrange" type="text">

               <select name="staff_id" id="staff-id" class="form-control input-group-append" style="max-width: 150px;">
                  <option value="">Select Staff</option>
                  @foreach(\App\Admin::where('role_id', \App\Admin::SALESMAN)->get() as $admin)
                  <option value="{{ $admin->id }}" @if(request()->get('staff_id') == $admin->id) selected @endif>{{ $admin->name }}</option>
                  @endforeach
               </select>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid mb-5">
   <div class="row size-column">
      <div class="col-xl-7 box-col-12 xl-100">
         <div class="row dash-chart">
             <div class="col-12">
                 <div class="mb-3">
                     @foreach(config('app.orders', []) as $status)
                         <a href="" class="btn @if($status == request('status')) btn-primary text-white @else btn-light @endif px-2 py-1 m-1" onclick="event.preventDefault(); window._status = '{{ $status }}'; refresh();">
                             <span>{{ $status }}</span>
                         </a>
                     @endforeach
                     <a href="" class="btn @if(request('status') == '') btn-primary text-white @else btn-light @endif px-2 py-1 m-1" onclick="event.preventDefault(); window._status = ''; refresh();">
                        <span>All</span>
                     </a>
                 </div>
             </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card rounded-sm o-hidden">
                  <div class="card-body p-3">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto mb-2">Total Products</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $productsCount }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card rounded-sm o-hidden">
                  <div class="card-body p-3">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto mb-2">Inactive Products</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $inactiveProducts->count() }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card rounded-sm o-hidden">
                  <div class="card-body p-3">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto mb-2">Out Of Stock</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $outOfStockProducts->count() }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            @foreach($orders as $status => $count)
            <div class="col-xl-3 box-col- col-lg-3 col-md-3">
               <div class="card rounded-sm o-hidden">
                  <div class="card-body p-3">
                     <div class="media">
                        <div class="media-body">
                           @php
                              $statData = compact('status');
                              if ($loop->index == 0) {
                                 $statData = ['status' => ''];
                              } else if ($loop->index < 3) {
                                 $statData = ['status' => '', 'type' => $status];
                              }
                           @endphp
                            <a href="{{
                              route('admin.orders.index', array_merge(array_merge([
                                 'start_d' => date('Y-m-d'), 'end_d' => date('Y-m-d'),
                              ], request()->query()), $statData))
                           }}">
                                <p class="f-w-500 font-roboto mb-2">{{ $status }} Orders</p>
                                <h4 class="f-w-500 mb-0 f-26"><span class="-counter-">{{ $count }}</span></h4>
                                <span class="-counter-">Taka: {{ $amounts[$status] }}</span>
                            </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>

         <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
               <strong>Ordered Products</strong>
            </div>
            <div class="card-body p-3">
               @include('admin.reports.filtered')
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-50 box-col-12">
         <div class="card rounded-sm">
            <div class="card-header p-4 card-no-border">
               <h5>Inactive Products</h5>
            </div>
            <div class="card-body p-3">
               <div class="our-product">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <tbody class="f-w-500">
                           @foreach($inactiveProducts as $product)
                           <tr>
                              <td class="pl-2">
                                 <div class="media">
                                    <img class="img-fluid m-r-15 rounded-circle" src="{{ optional($product->base_image)->src }}" width="42" height="42" alt="">
                                    <div class="media-body">
                                       <a href="{{ route('admin.products.edit', $product) }}">{{ $product->name }}</a>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <p>SKU</p>
                                 <span>{{ $product->sku }}</span>
                              </td>
                              <td class="text-center">
                                 @if($product->price == $product->selling_price)
                                 <p>{!!  theMoney($product->price)  !!}</p>
                                 @else
                                 <del style="color: #ff0000;">{!!  theMoney($product->price)  !!}</del>
                                 <br>
                                 <ins style="text-decoration: none;">{!!  theMoney($product->selling_price)  !!}</ins>
                                 @endif
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="card rounded-sm">
            <div class="card-header p-4 card-no-border">
               <h5>Out Of Stock</h5>
            </div>
            <div class="card-body p-3">
               <div class="our-product">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <tbody class="f-w-500">
                           @foreach($outOfStockProducts as $product)
                           <tr>
                              <td class="pl-2">
                                 <div class="media">
                                    <img class="img-fluid m-r-15 rounded-circle" src="{{ optional($product->base_image)->src }}" width="42" height="42" alt="">
                                    <div class="media-body">
                                       <a href="{{ route('admin.products.edit', $product->parent_id ?? $product->id) }}">{{ $product->var_name }}</a>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <p>SKU</p>
                                 <span>{{ $product->sku }}</span>
                              </td>
                              <td class="text-center">
                                 <del style="color: #ff0000;">{!!  theMoney($product->price)  !!}</del>
                                 <br>
                                 <ins style="text-decoration: none;">{!!  theMoney($product->selling_price)  !!}</ins>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
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
        window._status = '{{ request('status' )}}';
        window._staff = '{{ request('staff_id') }}';
        window._type = '{{ request('date_type', 'created_at') }}';
        window._start = moment('{{ $start }}');
        window._end = moment('{{ $end }}');
        window.reportRangeCB = function (start, end) {
            window._start = start;
            window._end = end;
            refresh();
        };

        $('#datetype').on('change', function () {
            window._type = $(this).val();
            refresh();
        });

         $('#staff-id').on('change', function () {
            window._staff = $(this).val();
            refresh();
         });

         function refresh() {
            window.location = "{!! route('admin.home', ['status' => '_status', 'date_type' => 'd_type', 'start_d'=> '_start', 'end_d' => '_end', 'staff_id' => '_staff_id']) !!}".replace('_status', window._status).replace('d_type', window._type).replace('_start', window._start.format('YYYY-MM-DD')).replace('_end', window._end.format('YYYY-MM-DD')).replace('_staff_id', window._staff);
         }
    </script>
@endpush
