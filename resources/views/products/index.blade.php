@extends('layouts.yellow.master')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/') => 'Home',
    ],
    'active' => 'Products',
    'page_title' => 'Products'
])

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="products-view">
                    <div class="products-view__options">
                        <div class="view-options">
                            <div class="view-options__legend">Showing {{ count($products->items()) }} of {{ $products->total() }} products</div>
                            <div class="view-options__divider"></div>
                            <!-- <div class="view-options__control">
                                <label for="">Sort By</label>
                                <div>
                                    <select class="form-control form-control-sm" name="" id="">
                                        <option value="">Default</option>
                                        <option value="">Name (A-Z)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="view-options__control">
                                <label for="">Show</label>
                                <div>
                                    <select class="form-control form-control-sm" name="" id="">
                                        <option value="">15</option>
                                        <option value="">20</option>
                                        <option value="">25</option>
                                        <option value="">30</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="products-view__list products-list" data-layout="grid-5-full" data-with-features="false">
                        <div class="products-list__body">
                            @foreach($products as $product)
                            <div class="products-list__item">
                                <div class="product-card">
                                    <div class="product-card__image">
                                        <a href="{{ route('products.show', $product) }}">
                                            <img src="{{ $product->base_image->src }}" alt="Base Image">
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
                            @endforeach
                        </div>
                    </div>
                    <div class="products-view__pagination">
                        <!-- <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link--with-arrow" href="#" aria-label="Previous">
                                    <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">
                                        <use xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-left-8x13') }}"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link page-link--with-arrow" href="#" aria-label="Next">
                                    <svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">
                                        <use xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-right-8x13') }}"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul> -->
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection