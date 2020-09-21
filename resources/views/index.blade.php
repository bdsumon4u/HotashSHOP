@extends('layouts.yellow.master')

@section('content')
@include('partials.slides')

<!-- .block-features -->
<div class="block block-features block-features--layout--classic">
    <div class="container">
        <div class="block-features__list">
            <div class="block-features__item">
                <div class="block-features__icon"><svg width="48px" height="48px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#fi-free-delivery-48') }}"></use>
                    </svg></div>
                <div class="block-features__content">
                    <div class="block-features__title">Free Shipping</div>
                    <div class="block-features__subtitle">For orders from $50</div>
                </div>
            </div>
            <div class="block-features__divider"></div>
            <div class="block-features__item">
                <div class="block-features__icon"><svg width="48px" height="48px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#fi-24-hours-48') }}"></use>
                    </svg></div>
                <div class="block-features__content">
                    <div class="block-features__title">Support 24/7</div>
                    <div class="block-features__subtitle">Call us anytime</div>
                </div>
            </div>
            <div class="block-features__divider"></div>
            <div class="block-features__item">
                <div class="block-features__icon"><svg width="48px" height="48px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#fi-payment-security-48') }}"></use>
                    </svg></div>
                <div class="block-features__content">
                    <div class="block-features__title">100% Safety</div>
                    <div class="block-features__subtitle">Only secure payments</div>
                </div>
            </div>
            <div class="block-features__divider"></div>
            <div class="block-features__item">
                <div class="block-features__icon"><svg width="48px" height="48px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#fi-tag-48') }}"></use>
                    </svg></div>
                <div class="block-features__content">
                    <div class="block-features__title">Hot Offers</div>
                    <div class="block-features__subtitle">Discounts up to 90%</div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .block-features / end -->
@foreach($sections as $section)
<!-- .block-products-carousel -->
@includeWhen($section->type == 'carousel-grid', 'partials.products-carousel.grid', [
    'title' => $section->title,
    'products' => $section->products(),
    'rows' => optional($section->data)->rows,
    'cols' => optional($section->data)->cols,
])
<!-- .block-products-carousel / end -->
@endforeach

@endsection