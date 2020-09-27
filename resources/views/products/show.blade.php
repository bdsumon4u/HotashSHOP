@extends('layouts.yellow.master')

@section('title', $product->name)

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/')                => 'Home',
        route('products.index') => 'Products',
    ],
    'active' => $product->name,
])

<div class="block">
    <div class="container">
        <div class="product product--layout--standard" data-layout="standard">
            <div class="product__content" data-id="{{ $product->id }}" data-max="{{ $product->should_track ? $product->stock_count : -1 }}">
                <!-- .product__gallery -->
                <div class="product__gallery">
                    <div class="product-gallery">
                        <div class="product-gallery__featured">
                            <div class="owl-carousel" id="product-image">
                                <a href="{{ asset($product->base_image->src) }}" target="_blank">
                                    <img class="product-base__image" data-detail="{{ route('products.show', $product) }}" src="{{ asset($product->base_image->src) }}" alt="Base Image">
                                </a>
                                @foreach($product->additional_images as $image)
                                <a href="{{ asset($image->src) }}" target="_blank">
                                    <img src="{{ asset($image->src) }}" alt="Additional Image">
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="product-gallery__carousel">
                            <div class="owl-carousel" id="product-carousel">
                                <a href="#" class="product-gallery__carousel-item">
                                    <img class="product-gallery__carousel-image" src="{{ asset($product->base_image->src) }}" alt="Base Image">
                                </a>
                                @foreach($product->additional_images as $image)
                                <a href="#" class="product-gallery__carousel-item">
                                    <img class="product-gallery__carousel-image" src="{{ asset($image->src) }}" alt="Additional Image">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- .product__gallery / end -->
                <!-- .product__info -->
                <div class="product__info">
                    <h1 class="product__name">{{ $product->name }}</h1>
                    <ul class="product__meta">
                        <li class="product__meta-availability w-100 mb-2">Availability:
                            @if(! $product->should_track)
                            <span class="text-success">In Stock</span>
                            @else
                            <span class="text-{{ $product->stock_count ? 'success' : 'danger' }}">{{ $product->stock_count }} In Stock</span>
                            @endif
                        </li>
                        <li class="w-100 mb-2">Brand: <a href="{{ route('brands.products', $product->brand) }}" class="text-primary">{{ $product->brand->name }}</a></li>
                        <li class="w-100 mb-2">Product Code: <strong>{{ $product->sku }}</strong></li>
                    </ul>
                </div><!-- .product__info / end -->
                <!-- .product__sidebar -->
                <div class="product__sidebar">
                    <div class="product__prices {{$product->selling_price == $product->price ? '' : 'has-special'}}">
                        Price:
                        @if($product->selling_price == $product->price)
                        {!!  theMoney($product->price)  !!}
                        @else
                        <span class="product-card__new-price">{!!  theMoney($product->selling_price)  !!}</span>
                        <span class="product-card__old-price">{!!  theMoney($product->price)  !!}</span>
                        @endif
                    </div>
                    <div class="call-for-order">
                        <img src="https://tonnicollection.com/public/storage/call-now.gif" width="287" height="68" alt="Call For Order">
                        <div style="padding: 10px;margin-bottom: 10px;font-weight: bold;color: red;padding-left: 5rem;margin-top: -35px;">
                            01721-267467
                        </div>
                    </div>
                    <!-- .product__options -->
                    <form class="product__options">
                        <div class="form-group product__option">
                            <label class="product__option-label" for="product-quantity">Quantity</label>
                            <div class="product__actions flex-column">
                                <div class="product__actions-item">
                                    <div class="input-number product__quantity">
                                        <input id="product-quantity"
                                            class="input-number__input form-control form-control-lg"
                                            type="number" min="1" {{ $product->should_track ? 'max='.$product->stock_count : '' }} value="1">
                                        <div class="input-number__add"></div>
                                        <div class="input-number__sub"></div>
                                    </div>
                                </div>
                                @exp($available = !$product->should_track || $product->stock_count > 0)
                                <div class="product__buttons d-flex">
                                    <div class="product__actions-item product__actions-item--addtocart">
                                        <button class="btn btn-primary product__addtocart" {{ $available ? '' : 'disabled' }}>Add to cart</button>
                                    </div>
                                    <div class="product__actions-item product__actions-item--ordernow">
                                        <button class="btn btn-primary product__ordernow" {{ $available ? '' : 'disabled' }}>Order Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><!-- .product__options / end -->
                </div><!-- .product__end -->
                <div class="product__footer">
                    <div class="product__tags tags">
                        <p class="text-secondary mb-2">Categories:</p>
                        <div class="tags__list">
                            @foreach($product->categories as $category)
                            <a href="{{ route('categories.products', $category) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tabs">
            <div class="product-tabs__list" style="background-color: antiquewhite;">
                <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Product Description</a>
                <a href="#tab-delivery-payment" class="product-tabs__item">Delivery & Payment</a>
            </div>
            <div class="product-tabs__content p-3">
                <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                    <h3>Product Description</h3>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tabs__pane" id="tab-delivery-payment">
                    <h3>Delivery & Payment</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header p-3">
                                    <h4>
                                        <i class="fa fa-check"> </i>
                                        আপনি ঢাকা সিটির ভীতরে হলেঃ-
                                    </h4>
                                </div>
                                <div class="card-body p-2">
                                    <div class="col-sm-12">
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            ক্যাশ অন ডেলিভারি/হ্যান্ড টু হ্যান্ড ডেলিভারি।
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            ডেলিভারি চার্জ
                                            ৬০
                                            টাকা।
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            পণ্যের টাকা ডেলিভারি ম্যানের কাছে প্রদান করবেন। 
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            অর্ডার কনফার্ম করার ৪৮ ঘণ্টার ভিতর ডেলিভারি পাবেন।
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে  ডেলিভারি চার্জ
                                            ৬০ 
                                            টাকা ডেলিভারি ম্যানকে প্রদান করতে বাধ্য থাকিবেন।
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header p-3">
                                    <h4>
                                        <i class="fa fa-check"> </i>
                                        আপনি ঢাকা সিটির বাহীরে হলেঃ- 
                                    </h4>
                                </div>
                                <div class="card-body p-2">
                                    <div class="col-sm-12">
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            কন্ডিশন বুকিং অন কুরিয়ার সার্ভিস (জননী কুরিয়ার অথবা এস এ পরিবহন কুরিয়ার সার্ভিস) এ নিতে হবে।
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            কুরিয়ার সার্ভিস চার্জ ১০০ টাকা বিকাশে অগ্রিম প্রদান করতে হবে। 
                                        </p>
                                    
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            কুরিয়ার চার্জ ১০০ টাকা বিকাশ করার পর ৪৮ ঘন্টার ভিতর কুরিয়ার হতে পণ্য গ্রহন করতে  হবে এবং পণ্যের টাকা কুরিয়ার অফিসে প্রদান করতে হবে। 
                                        </p>
                                        <p>
                                            <i class="fa  fa-arrow-circle-right "> </i> 
                                            বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে  কুরিয়ার চার্জ ১০০ টাকা কুরিয়ার অফিসে প্রদান করে পণ্য আমাদের ঠিকানায় রিটার্ন করবেন। আমরা প্রয়োজনীয় ব্যবস্থা নিব। 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .block-products-carousel -->
@include('partials.products-carousel.grid', [
    'title' => 'Related Products',
    'cols' => $related_products->cols,
    'rows' => $related_products->rows,
])
<!-- .block-products-carousel / end -->
@endsection