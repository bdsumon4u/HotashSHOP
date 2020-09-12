@extends('layouts.yellow.master')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/')                      => 'Home',
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
                        <li class="product__meta-availability">Availability:
                            @if(! $product->should_track)
                            <span class="text-success">In Stock</span>
                            @else
                            <span class="text-{{ $product->stock_count ? 'success' : 'danger' }}">{{ $product->stock_count }} In Stock</span>
                            @endif
                        </li>
                        <li>Brand: <a href="{{ route('brands.products', $product->brand) }}" class="text-primary">{{ $product->brand->name }}</a></li>
                        <li>SKU: {{ $product->sku }}</li>
                    </ul>
                </div><!-- .product__info / end -->
                <!-- .product__sidebar -->
                <div class="product__sidebar">
                    <div class="product__prices {{$product->selling_price == $product->price ? '' : 'has-special'}}">
                        @if($product->selling_price == $product->price)
                        $ <span>{{ $product->price }}</span>
                        @else
                        <span class="product-card__new-price">$ <span>{{ $product->selling_price }}</span></span>
                        <span class="product-card__old-price">$ <span>{{ $product->price }}</span></span>
                        @endif
                    </div>
                    <!-- .product__options -->
                    <form class="product__options">
                        <div class="form-group product__option">
                            <label class="product__option-label" for="product-quantity">Quantity</label>
                            <div class="product__actions">
                                <div class="product__actions-item">
                                    <div class="input-number product__quantity">
                                        <input id="product-quantity"
                                            class="input-number__input form-control form-control-lg"
                                            type="number" min="1" {{ $product->should_track ? 'max='.$product->stock_count : '' }} value="1">
                                        <div class="input-number__add"></div>
                                        <div class="input-number__sub"></div>
                                    </div>
                                </div>
                                <div class="product__actions-item product__actions-item--addtocart">
                                    <button class="btn btn-primary btn-lg">Add to cart</button>
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
            <div class="product-tabs__list">
                <a href="#tab-description" class="product-tabs__item product-tabs__item--active">Description</a>
            </div>
            <div class="product-tabs__content p-3">
                <div class="product-tabs__pane product-tabs__pane--active" id="tab-description">
                    <div class="typography">
                        <h3>Product Full Description</h3>
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .block-products-carousel -->


<div class="block block-products-carousel" data-layout="grid-5">
    <div class="container">
        <div class="block-header">
            <h3 class="block-header__title">Related Products</h3>
            <div class="block-header__divider"></div>
            <div class="block-header__arrows-list">
                <button class="block-header__arrow block-header__arrow--left" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-left-7x11') }}"></use>
                    </svg>
                </button>
                <button class="block-header__arrow block-header__arrow--right" type="button">
                    <svg width="7px" height="11px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-right-7x11') }}"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="block-products-carousel__slider">
            <div class="block-products-carousel__preloader"></div>
            <div class="owl-carousel">
                @foreach($relatedProducts as $product)
                <div class="block-products-carousel__column">
                    <div class="block-products-carousel__cell">
                        <div class="product-card">
                            <div class="product-card__image">
                                <a href="{{ route('products.show', $product) }}">
                                    <img src="{{ asset($product->base_image->src) }}" alt="Base Image">
                                </a>
                            </div>
                            <div class="product-card__info">
                                <div class="product-card__name">
                                    <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                </div>
                            </div>
                            <div class="product-card__actions">
                                <div class="product-card__availability">Availability:
                                    <span class="text-success">In Stock</span>
                                </div>
                                <div class="product-card__prices">$749.00</div>
                                <div class="product-card__buttons">
                                    <button class="btn btn-primary product-card__addtocart" type="button">Add To Cart</button>
                                    <button class="btn btn-secondary product-card__addtocart product-card__addtocart--list" type="button">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div><!-- .block-products-carousel / end -->
@endsection