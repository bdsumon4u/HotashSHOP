<div class="block block-products-carousel">
    <div class="container">
        @if($title ?? null)
            <div class="block-header">
                <h3 class="block-header__title">
                    @isset($section)
                        <a href="{{ route('home-sections.products', $section) }}" style="color:inherit;">{{ $title }}</a>
                    @else
                        {{ $title }}
                    @endisset
                </h3>
                <div class="block-header__divider"></div>
                @isset($section)
                    <a href="{{ route('products.index', ['section' => $section->id]) }}" class="btn btn-sm ml-0 block-header__arrows-list">
                        View All
                    </a>
                @endisset
            </div>
        @endif
        <div class="products-view__list products-list" data-layout="grid-{{ $cols ?? 5 }}-full" data-with-features="false">
            <div class="products-list__body">
                @foreach($products as $product)
                    <div class="products-list__item">
                        @include('partials.products.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
