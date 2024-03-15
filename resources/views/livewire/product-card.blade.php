<div class="product-card" data-id="{{ $product->id }}" data-max="{{ $product->should_track ? $product->stock_count : -1 }}">
    @exp($in_stock = !$product->should_track || $product->stock_count > 0)
    <div class="product-card__badges-list">
        @if(! $in_stock)
            <div class="product-card__badge product-card__badge--sale">Sold</div>
        @endif
        @if($product->price != $product->selling_price)
            <div class="product-card__badge product-card__badge--sale"><small>Discount:</small> {{ round(($product->price - $product->selling_price) * 100 / $product->price, 0, PHP_ROUND_HALF_UP) }}%</div>
        @endif
    </div>
    <div class="product-card__image">
        <a href="{{ route('products.show', $product) }}">
            <img src="{{ asset(optional($product->base_image)->src) }}" alt="Base Image">
        </a>
    </div>
    <div class="product-card__info">
        <div class="product-card__name">
            <a href="{{ route('products.show', $product) }}" data-name="{{ $product->var_name }}">{{ $product->name }}</a>
        </div>
    </div>
    <div class="product-card__actions">
        <div class="product-card__availability">Availability:
            @if(! $product->should_track)
                <span class="text-success">In Stock</span>
            @else
                <span class="text-{{ $product->stock_count ? 'success' : 'danger' }}">{{ $product->stock_count }} In Stock</span>
            @endif
        </div>
        <div class="product-card__prices {{$product->selling_price == $product->price ? '' : 'has-special'}}">
            @if($product->selling_price == $product->price)
                {!!  theMoney($product->price)  !!}
            @else
                <span class="product-card__new-price">{!!  theMoney($product->selling_price)  !!}</span>
                <span class="product-card__old-price">{!!  theMoney($product->price)  !!}</span>
            @endif
        </div>
        <div class="product-card__buttons">
            @exp($available = !$product->should_track || $product->stock_count > 0)
            @exp($show_option = setting('show_option'))
            @if(($show_option->product_grid_button ?? false) == 'add_to_cart')
            <button wire:click="addToCart" class="btn btn-primary product-card__addtocart" type="button" {{ $available ? '' : 'disabled' }}>
                {!! $show_option->add_to_cart_icon ?? null !!}
                <span class="ml-1">{{ $show_option->add_to_cart_text ?? '' }}</span>
            </button>
            @endif
            @if(($show_option->product_grid_button ?? false) == 'order_now')
            <button wire:click="orderNow" class="btn btn-primary product-card__ordernow" type="button" {{ $available ? '' : 'disabled' }}>
                {!! $show_option->order_now_icon ?? null !!}
                <span class="ml-1">{{ $show_option->order_now_text ?? '' }}</span>
            </button>
            @endif
        </div>
    </div>
</div>