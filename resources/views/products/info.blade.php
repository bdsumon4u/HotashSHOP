<div class="product__info">
    <h1 class="product__name" data-name="{{$selectedVar->var_name}}">{{ $product->name }}</h1>
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
    <div class="product__prices {{$selectedVar->selling_price == $selectedVar->price ? '' : 'has-special'}}">
        Price:
        @if($selectedVar->selling_price == $selectedVar->price)
            {!!  theMoney($selectedVar->price)  !!}
        @else
            <span class="product-card__new-price">{!!  theMoney($selectedVar->selling_price)  !!}</span>
            <span class="product-card__old-price">{!!  theMoney($selectedVar->price)  !!}</span>
        @endif
    </div>

    @foreach($attributes as $attribute)
    <div class="form-group product__option">
        <label class="product__option-label">{{$attribute->name}}</label>
        @if (strtolower($attribute->name) == 'color')
        <div class="input-radio-color">
            <div class="input-radio-color__list">
                {{-- <label class="input-radio-color__item input-radio-color__item--white" style="color: #fff;" data-toggle="tooltip" title="" data-original-title="White">
                    <input type="radio" name="color">
                    <span></span>
                </label> --}}
                @foreach($optionGroup[$attribute->id] as $option)
                <label class="input-radio-color__item @if(strtolower($option->name) == 'white') input-radio-color__item--white @endif" style="color: {{$option->value}};" data-toggle="tooltip" title="" data-original-title="{{$option->name}}">
                    <input type="radio" name="options[{{$attribute->id}}]" value="{{$option->id}}" class="option-picker" @if($selectedVar->options->contains($option)) checked @endif>
                    <span></span>
                </label>
                @endforeach
                {{-- <label class="input-radio-color__item input-radio-color__item--disabled" style="color: #4080ff;" data-toggle="tooltip" title="" data-original-title="Blue">
                    <input type="radio" name="color" disabled="disabled">
                    <span></span>
                </label> --}}
            </div>
        </div>
        @else
        <div class="input-radio-label">
            <div class="input-radio-label__list">
                @foreach($optionGroup[$attribute->id] as $option)
                <label>
                    <input type="radio" name="options[{{$attribute->id}}]" value="{{$option->id}}" class="option-picker" @if($selectedVar->options->contains($option)) checked @endif>
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
            <div class="form-group product__option">
                {{-- <label class="product__option-label" for="product-quantity">Quantity</label> --}}
                <div class="product__actions-item d-flex justify-content-between align-items-center border-top pt-1">
                    <big>Quantity</big>
                    <div class="input-number product__quantity">
                        <input id="product-quantity"
                                class="input-number__input form-control form-control-lg"
                                type="number" min="1" {{ $selectedVar->should_track ? 'max='.$selectedVar->stock_count : '' }} value="1">
                        <div class="input-number__add"></div>
                        <div class="input-number__sub"></div>
                    </div>
                </div>
                <div class="product__actions overflow-hidden">
                    @exp($available = !$selectedVar->should_track || $selectedVar->stock_count > 0)
                    <div class="product__buttons w-100">
                        <div class="product__actions-item product__actions-item--ordernow">
                            <button class="btn btn-primary product__ordernow btn-lg btn-block" {{ $available ? '' : 'disabled' }}>অর্ডার করুন</button>
                        </div>
                        <div class="product__actions-item product__actions-item--addtocart">
                            <button class="btn btn-primary product__addtocart btn-lg btn-block" {{ $available ? '' : 'disabled' }}>কার্টে যোগ করুন</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="call-for-order">
                {{-- <img src="{{ asset('call-now-icon-20.jpg') }}" width="135" alt="Call For Order">
                <div style="padding: 10px;margin-bottom: 10px;font-weight: bold;color: red;">
                    {!! implode('<br>', explode(' ', setting('call_for_order'))) !!}
                </div> --}}
                @foreach (explode(' ', setting('call_for_order')) as $phone)
                    <a href="tel:{{$phone}}" class="btn ptn-primary text-white w-100 mb-1" style="background: #008acf; height: auto;">
                        <div>কল করতে ক্লিক করুন</div>
                        <div>
                            <i class="fa fas fa-phone mr-2"></i>
                            <span>{{$phone}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </form><!-- .product__options / end -->
    </div><!-- .product__end -->
</div>
