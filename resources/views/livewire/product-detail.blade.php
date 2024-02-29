<div class="product__info">
    <h3 class="product__name mb-2" data-name="{{$selectedVar->var_name}}">{{ $product->name }}</h1>
    <div class="w-100 border-top pt-2">Product Code: <strong>{{ $selectedVar->sku }}</strong></div>
    <div class="w-100 mb-2">Availability:
        <strong>
            @if(! $selectedVar->should_track)
                <span class="text-success">In Stock</span>
            @else
                <span class="text-{{ $selectedVar->stock_count ? 'success' : 'danger' }}">{{ $selectedVar->stock_count }} In Stock</span>
            @endif
        </strong>
    </div>
    <div class="product__prices mb-1 {{$selectedVar->selling_price == $selectedVar->price ? '' : 'has-special'}}">
        Price:
        @if($selectedVar->selling_price == $selectedVar->price)
            {!!  theMoney($selectedVar->price)  !!}
        @else
            <span class="product-card__new-price">{!!  theMoney($selectedVar->selling_price)  !!}</span>
            <span class="product-card__old-price">{!!  theMoney($selectedVar->price)  !!}</span>
        @endif
    </div>

    @foreach($attributes as $attribute)
    <div class="form-group product__option mb-1">
        <label class="product__option-label">{{$attribute->name}}</label>
        @if (strtolower($attribute->name) == 'color')
        <div class="input-radio-color">
            <div class="input-radio-color__list">
                @foreach($optionGroup[$attribute->id] as $option)
                <label class="input-radio-color__item @if(strtolower($option->name) == 'white') input-radio-color__item--white @endif" style="color: {{$option->value}};" data-toggle="tooltip" title="" data-original-title="{{$option->name}}">
                    <input type="radio" wire:model="options.{{$attribute->id}}" name="options[{{$attribute->id}}]" value="{{$option->id}}" class="option-picker">
                    <span></span>
                </label>
                @endforeach
            </div>
        </div>
        @else
        <div class="input-radio-label">
            <div class="input-radio-label__list">
                @foreach($optionGroup[$attribute->id] as $option)
                <label>
                    <input type="radio" wire:model="options.{{$attribute->id}}" name="options[{{$attribute->id}}]" value="{{$option->id}}" class="option-picker">
                    <span>{{$option->name}}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    @endforeach
    <!-- .product__sidebar -->
    <div class="product__sidebar">
        <!-- .product__options -->
        <form class="product__options">
            <div class="form-group product__option mb-1">
                {{-- <label class="product__option-label" for="product-quantity">Quantity</label> --}}
                <div class="product__actions-item d-flex justify-content-between align-items-center border-top pt-1">
                    <big>Quantity</big>
                    <div class="input-number product__quantity">
                        <input id="product-quantity"
                                class="input-number__input form-control form-control-lg" wire:model.defer="quantity"
                                type="number" min="1" @if($selectedVar->should_track) max="{{$selectedVar->stock_count}}" @endif value="1" readonly>
                        <div class="input-number__add" wire:click="increment"></div>
                        <div class="input-number__sub" wire:click="decrement"></div>
                    </div>
                </div>
                <div class="product__actions overflow-hidden">
                    @exp($available = !$selectedVar->should_track || $selectedVar->stock_count > 0)
                    <div class="product__buttons w-100">
                        <div class="product__actions-item product__actions-item--ordernow">
                            <button type="button" wire:click="orderNow" class="btn btn-primary product__ordernow btn-lg btn-block" {{ $available ? '' : 'disabled' }}>অর্ডার করুন</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="call-for-order">
                @foreach (explode(' ', setting('call_for_order')) as $phone)
                    <a href="tel:{{$phone}}" class="btn btn-secondary w-100 mb-1" style="height: auto;">
                        <div>কল করতে ক্লিক করুন</div>
                        <div>
                            <i class="fa fas fa-phone mr-2"></i>
                            <span>{{$phone}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($free_delivery->enabled && $deliveryText)
            <div class="text-center font-weight-bold border">
                <p class="border-bottom mb-1">আজ অর্ডার করলে <br> সারা বাংলাদেশে ডেলিভারি চার্জ <strong class="text-danger">ফ্রি</strong></p>
                {!! $deliveryText !!}
            </div>
            @endif
        </form><!-- .product__options / end -->
    </div><!-- .product__end -->
</div>
