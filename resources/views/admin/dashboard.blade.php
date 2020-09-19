@extends('layouts.light.master')
@section('title', 'Ecommerce')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ecommerce</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid mb-5">
   <div class="row size-column">
      <div class="col-xl-7 box-col-12 xl-100">
         <div class="row dash-chart">
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Total Products</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $productsCount }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Inactive Products</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $inactiveProducts->count() }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="ecommerce-widgets media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Out Of Stock</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $outOfStockProducts->count() }}</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Total Orders</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $ordersCount }}</span></h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Pending Orders</p>
                           <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $pendingOrdersCount }}</span></h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-4 col-md-4">
               <div class="card o-hidden">
                  <div class="card-body">
                     <div class="media">
                        <div class="media-body">
                           <p class="f-w-500 font-roboto">Return Rate</p>
                           <div class="progress-box">
                              <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $returnedOrdersCount }}</span></h4>
                              <div class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                 <div class="progress-gradient-primary" role="progressbar" style="width: {{round($returnedOrdersCount * 100 / $ordersCount)}}%" aria-valuenow="{{ round($returnedOrdersCount * 100 / $ordersCount) }}" aria-valuemin="0" aria-valuemax="100"><span class="font-primary">{{ round($returnedOrdersCount * 100 / $ordersCount) }} %</span><span class="animate-circle"></span></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-50 box-col-12">
         <div class="card">
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
                                    <img class="img-fluid m-r-15 rounded-circle" src="{{ $product->base_image->src }}" width="42" height="42" alt="">
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
                                 <p>$ <span>{{ $product->price }}</span></p>
                                 @else
                                 <del style="color: #ff0000;">$ <span>{{ $product->price }}</span></del>
                                 <br>
                                 <ins style="text-decoration: none;">$ <span>{{ $product->selling_price }}</span></ins>
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
      </div>
      <div class="col-xl-4 xl-50 box-col-12">
         <div class="card">
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
                                    <img class="img-fluid m-r-15 rounded-circle" src="{{ $product->base_image->src }}" width="42" height="42" alt="">
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
                                 <del style="color: #ff0000;">$ <span>{{ $product->price }}</span></del>
                                 <br>
                                 <ins style="text-decoration: none;">$ <span>{{ $product->selling_price }}</span></ins>
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

@section('script')
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
@endsection

