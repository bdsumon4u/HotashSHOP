@extends('layouts.yellow.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('strokya/vendor/xzoom/xzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('strokya/vendor/xZoom-master/example/css/demo.css') }}">
    <style>
        #accordion .card-link {
            display: block;
            font-size: 20px;
            padding: 18px 48px;
            border-bottom: 2px solid transparent;
            color: inherit;
            font-weight: 500;
            border-radius: 3px 3px 0 0;
            transition: all .15s;
        }
        #accordion .card-link:not(.collapsed) {
            border-bottom: 2px solid #000;
            color: #000;
        }

        iframe {
            width: 100%;
        }

        @media (max-width: 768px) {
            .product__option-label {
                display: block;
            }
            .product__actions {
                justify-content: center;
            }
            .product__actions-item {
                width: 100%;
            }
        }
        .product__content {
            grid-template-columns: [gallery] calc(40% - 30px) [info] calc(40% - 35px) [sidebar] calc(25% - 10px);
            grid-column-gap: 10px;
        }

        img {
            max-width: 100%;
            /*height: auto;*/
        }
    </style>
@endpush

@section('title', $product->name)

@section('content')
    <div class="block mt-1">
        <div class="container">
            <div class="product product--layout--standard" data-layout="standard">
                <div class="product__content">
                    <div class="xzoom-container">
                        <img class="xzoom" id="xzoom-default" src="{{ asset($product->base_image->src) }}" xoriginal="{{ asset($product->base_image->src) }}" />
                        <div class="xzoom-thumbs d-flex mt-2">
                            <a href="{{ asset($product->base_image->src) }}"><img data-detail="{{ route('products.show', $product) }}" class="xzoom-gallery product-base__image" width="80" src="{{ asset($product->base_image->src) }}"  xpreview="{{ asset($product->base_image->src) }}"></a>
                            @foreach($product->additional_images as $image)
                                <a href="{{ asset($image->src) }}">
                                    <img class="xzoom-gallery" width="80" src="{{ asset($image->src) }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- .product__info -->
                    <livewire:product-detail :product="$product" />
                    <!-- .product__info / end -->
                    <div>
                        <div class="product__footer mt-2 mb-2 border p-3">
                            <div class="product__tags tags">
                                @if($product->brand)
                                    <p class="text-secondary mb-0">
                                        Brand: <a href="{{ route('brands.products', $product->brand) }}" class="text-primary badge badge-light"><big>{{ $product->brand->name }}</big></a>
                                    </p>
                                @endif
                                <div class="mt-2">
                                    <p class="text-secondary mb-0 d-inline-block mr-2">Categories:</p>
                                    @foreach($product->categories as $category)
                                        <a href="{{ route('categories.products', $category) }}" class="badge badge-primary">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="block-features__list flex-column d-block">
                            @if($services = setting('services'))
                                @foreach(config('services.services', []) as $num => $icon)
                                    <div class="block-features__item">
                                        <div class="block-features__icon">
                                            <svg width="48px" height="48px">
                                                <use xlink:href="{{ asset($icon) }}"></use>
                                            </svg>
                                        </div>
                                        <div class="block-features__content">
                                            <div class="block-features__title">{{ $services->$num->title }}</div>
                                            <div class="block-features__subtitle">{{ $services->$num->detail }}</div>
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="block-features__divider"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="accordion" class="mt-3">
                <div class="card">
                    <div class="card-header p-0">
                        <a class="card-link px-4" datatoggle="collapse" href="javascript:void(false)">
                            Product Description
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body p-2">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-0">
                        <a class="card-link px-4" datatoggle="collapse" href="javascript:void(false)">
                            Delivery and Payment
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                        <div class="card-body p-2">
                            {!! setting('delivery_text') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .block-products-carousel -->
    @include('partials.products.pure-grid', [
        'title' => 'Related Products',
        'cols' => $related_products->cols,
        'rows' => $related_products->rows,
    ])
    <!-- .block-products-carousel / end -->
@endsection

@push('scripts')
    <script src="{{ asset('strokya/vendor/xzoom/xzoom.min.js') }}"></script>
    <script src="{{ asset('strokya/vendor/xZoom-master/example/js/vendor/modernizr.js') }}"></script>
    <script src="{{ asset('strokya/vendor/xZoom-master/example/js/setup.js') }}"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
