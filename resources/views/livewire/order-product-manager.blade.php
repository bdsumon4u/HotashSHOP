<div class="card rounded-0 shadow-sm">
    <div class="card-header p-3">
        <h5 class="card-title">Ordered Products</h5>
    </div>
    <div class="card-body p-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <input type="search" wire:model.debounce.250ms="search" id="search"
                    placeholder="Search Product" class="form-control">
            </div>
        </div>
        <div class="table-responsive my-2">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $selectedVar = $product;
                            if ($product->variations->isNotEmpty()) {
                                $selectedVar = $product->variations->random();
                            }

                            if (isset($options[$product->id])) {
                                $variation = $product->variations->first(function ($item) use ($options, $product) {
                                    return $item->options->pluck('id')->diff($options[$product->id])->isEmpty();
                                });
                                if ($variation) {
                                    $selectedVar = $variation;
                                }
                            }

                            $dataId = $selectedVar->id;
                            $dataMax = $selectedVar->should_track ? $selectedVar->stock_count : -1;

                            $optionGroup = $product->variations->pluck('options')->flatten()->unique('id')->groupBy('attribute_id');
                            $attributes = \App\Attribute::find($optionGroup->keys());
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ optional($selectedVar->base_image)->src }}" width="100"
                                    height="100" alt="">
                            </td>
                            <td>
                                <a class="mb-2 d-block"
                                    href="{{ route('products.show', $selectedVar->slug) }}">{{ $product->name }}</a>
                                
                                @foreach($attributes as $attribute)
                                <div class="form-group product__option mb-2">
                                    <label class="product__option-label">{{$attribute->name}}</label>
                                    <div class="input-radio-label">
                                        <div class="input-radio-label__list">
                                            @foreach($optionGroup[$attribute->id] as $option)
                                            <label>
                                                <input type="radio" wire:model="options.{{$product->id}}.{{$attribute->id}}" value="{{$option->id}}" class="option-picker">
                                                <span>{{$option->name}}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <div class="w-100 mb-2">Availability:
                                    <strong>
                                        @if(! $selectedVar->should_track)
                                            <span class="text-success">In Stock</span>
                                        @else
                                            <span class="text-{{ $selectedVar->stock_count ? 'success' : 'danger' }}">{{ $selectedVar->stock_count }} In Stock</span>
                                        @endif
                                    </strong>
                                </div>
                                <div class="product__prices mb-2 {{$selectedVar->selling_price == $selectedVar->price ? '' : 'has-special'}}">
                                    Price:
                                    @if($selectedVar->selling_price == $selectedVar->price)
                                        {!!  theMoney($selectedVar->price)  !!}
                                    @else
                                        <span class="product-card__new-price">{!!  theMoney($selectedVar->selling_price)  !!}</span>
                                        <span class="product-card__old-price">{!!  theMoney($selectedVar->price)  !!}</span>
                                    @endif
                                </div>

                                @if($available = !$selectedVar->should_track || $selectedVar->stock_count > 0)
                                <button type="button" class="btn btn-primary"
                                    wire:click="addProduct({{ $selectedVar }})">Add to Order</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($order->products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image }}" width="100"
                                    height="100" alt="">
                            </td>
                            <td>
                                <a
                                    href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    name="quantity[{{ $product->id }}]"
                                    id="quantity-{{ $product->id }}"
                                    value="{{ old('quantity.' . $product->id, $product->quantity) }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-success ml-auto d-block" type="submit"
            formaction="{{ route('admin.orders.update-quantity', $order) }}">Update</button>
    </div>
</div>