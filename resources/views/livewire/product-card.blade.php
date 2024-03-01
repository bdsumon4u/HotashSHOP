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
            <img src="{{ $product->base_image->src }}" alt="Base Image">
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
            {{-- <button class="btn btn-primary product-card__addtocart" type="button" {{ $available ? '' : 'disabled' }}>Add To Cart</button> --}}
            <button wire:click="orderNow" class="btn btn-primary product-card__ordernow" type="button" {{ $available ? '' : 'disabled' }}>
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7 8V6a5 5 0 1 1 10 0v2h3a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3zm0 2H5v10h14V10h-2v2h-2v-2H9v2H7v-2zm2-2h6V6a3 3 0 0 0-6 0v2z"></path></svg>
                <span class="ml-1">অর্ডার করুন</span>
            </button>
        </div>
    </div>
</div>