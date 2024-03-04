<div class="product__info">
    <h3 class="product__name mb-2" data-name="{{$selectedVar->var_name}}">{{ $product->name }}</h1>
    <div class="d-flex justify-content-between border-top pt-2 mb-2">
        <div>Code: <strong>{{ $selectedVar->sku }}</strong></div>
        <div>Availability:
            <strong>
                @if(! $selectedVar->should_track)
                    <span class="text-success">In Stock</span>
                @else
                    <span class="text-{{ $selectedVar->stock_count ? 'success' : 'danger' }}">{{ $selectedVar->stock_count }} In Stock</span>
                @endif
            </strong>
        </div>
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
                                type="number" min="1" max="{{$maxQuantity}}" value="1" readonly>
                        <div class="input-number__add" wire:click="increment"></div>
                        <div class="input-number__sub" wire:click="decrement"></div>
                    </div>
                </div>
                <div class="product__actions overflow-hidden">
                    @exp($available = !$selectedVar->should_track || $selectedVar->stock_count > 0)
                    <div class="product__buttons w-100">
                        <div class="product__actions-item product__actions-item--ordernow">
                            <button type="button" wire:click="orderNow" class="btn btn-primary product__ordernow btn-lg btn-block" {{ $available ? '' : 'disabled' }}>
                                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7 8V6a5 5 0 1 1 10 0v2h3a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3zm0 2H5v10h14V10h-2v2h-2v-2H9v2H7v-2zm2-2h6V6a3 3 0 0 0-6 0v2z"></path></svg>
                                <span class="ml-1">অর্ডার করুন</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="call-for-order p-1 text-center mt-2" style="border: 2px dashed #dedede;">
                <div>এই পণ্য সম্পর্কে প্রশ্ন আছে? অনুগ্রহপূর্বক কল করুন:</div>
                @foreach (explode(' ', setting('call_for_order')) as $phone)
                    @if ($phone = trim($phone))
                    <a href="tel:{{$phone}}" class="text-danger">
                        <div class="lead mt-1">
                            <i class="fa fas fa-phone mr-2"></i>
                            <span>{{$phone}}</span>
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
            @if($free_delivery->enabled && $deliveryText)
            <div class="text-center font-weight-bold border mt-2">
                <p class="border-bottom mb-1">আজ অর্ডার করলে <br> সারা বাংলাদেশে ডেলিভারি চার্জ <strong class="text-danger">ফ্রি</strong></p>
                {!! $deliveryText !!}
            </div>
            @endif
        </form><!-- .product__options / end -->
    </div><!-- .product__end -->
</div>
