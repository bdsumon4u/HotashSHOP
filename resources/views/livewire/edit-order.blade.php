<div class="row">
    <div class="col-12 col-lg-6 col-xl-7">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
                <h5 class="card-title">Billing details</h5>
            </div>
            <div class="card-body p-3">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <x-label for="name">Name</x-label> <span
                            class="text-danger">*</span>
                        <x-input name="order.name" wire:model.defer="order.name" placeholder="Type your name here" />
                        <x-error field="order.name" />
                    </div>
                    <div class="form-group col-md-6">
                        <x-label for="phone">Phone</x-label> <span
                            class="text-danger">*</span>
                        <x-input type="tel" name="order.phone" wire:model.defer="order.phone" placeholder="Type your phone number here" />
                        <x-error field="order.phone" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <x-label for="email">Email Address</x-label>
                        <x-input type="email" name="order.email" wire:model.defer="order.email" placeholder="Email Address" />
                        <x-error field="order.email" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="d-block">Delivery Charge City <span
                            class="text-danger">*</span></label>
                    <div class="form-control h-auto @error('order.data.shipping_area') is-invalid @enderror">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="inside-dhaka"
                                name="order.data.shipping" wire:model="order.data.shipping_area" value="Inside Dhaka">
                            <label class="custom-control-label" for="inside-dhaka">Inside
                                Dhaka</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input"
                                id="outside-dhaka" name="shipping" wire:model="order.data.shipping_area" value="Outside Dhaka">
                            <label class="custom-control-label" for="outside-dhaka">Outside
                                Dhaka</label>
                        </div>
                    </div>
                    <x-error field="order.data.shipping_area" />
                </div>
                <div class="form-group">
                    <x-label for="address">Address</x-label> <span class="text-danger">*</span>
                    <x-input name="order.address" wire:model.defer="order.address" placeholder="Enter Correct Address" />
                    <x-error field="order.address" />
                </div>
                <div class="form-group">
                    <label class="d-block">Courier <span class="text-danger">*</span></label>
                    <div class="border p-2 @error('order.data.courier') is-invalid @enderror">
                        @foreach (['Pathao', 'SteadFast', 'Other'] as $provider)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input"
                                    id="{{ $provider }}" wire:model="order.data.courier"
                                    value="{{ $provider }}"
                                    {{ ($order->data['courier'] ?? false) == $provider ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="{{ $provider }}">{{ $provider }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-error field="order.data.courier" />
                </div>
                <div Pathao class="form-row @if (($order->data['courier'] ?? false) != 'Pathao') d-none @endif">
                    <div class="form-group col-md-4">
                        <label for="">City</label>
                        <select class="form-control" wire:model="order.data.city_id">
                            <option value="" selected>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->city_id }}">
                                    {{ $city->city_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-error field="data[city_id]" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Area</label>
                        <div wire:loading.class="d-flex" wire:target="order.data.city_id" class="d-none h-100 align-items-center">
                            Loading Area...
                        </div>
                        <select wire:loading.remove wire:target="order.data.city_id" class="form-control" wire:model.defer="order.data.area_id">
                            <option value="" selected>Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->zone_id }}">
                                    {{ $area->zone_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-error field="data[area_id]" />
                    </div>
                    <div class="col-md-4">
                        <label for="weight">Weight</label>
                        <input type="number" wire:model.defer="order.data.weight" class="form-control" placeholder="Weight in KG">
                    </div>
                </div>
            </div>
        </div>
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
                <h5 class="card-title">Ordered Products</h5>
            </div>
            <div class="card-body p-3">
                <div class="row px-3">
                    <input type="search" wire:model.debounce.250ms="search" id="search"
                        placeholder="Search Product" class="col-md-6 form-control">
                    
                    @if (session()->has('error'))
                        <strong class="col-md-6 text-danger d-flex align-items-center">{{ session('error') }}</strong>
                    @endif
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
        
                                    $order->dataId = $selectedVar->id;
                                    $order->dataMax = $selectedVar->should_track ? $selectedVar->stock_count : -1;
        
                                    $optionGroup = $product->variations->pluck('options')->flatten()->unique('id')->groupBy('attribute_id');
                                    $attributes = \App\Attribute::find($optionGroup->keys());
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ asset(optional($selectedVar->base_image)->src) }}" width="100"
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
                                        <div class="mb-2 {{$selectedVar->selling_price == $selectedVar->price ? '' : 'has-special'}}">
                                            Price:
                                            @if($selectedVar->selling_price == $selectedVar->price)
                                                {!!  theMoney($selectedVar->price)  !!}
                                            @else
                                                <span class="font-weight-bold">{!!  theMoney($selectedVar->selling_price)  !!}</span>
                                                <del class="text-danger">{!!  theMoney($selectedVar->price)  !!}</del>
                                            @endif
                                        </div>
        
                                        @if($available = !$selectedVar->should_track || $selectedVar->stock_count > 0)
                                        <button type="button" class="btn btn-primary"
                                            wire:click="addProduct({{ $selectedVar }})">Add to Order</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($selectedProducts as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset($product['image']) }}" width="100"
                                            height="100" alt="">
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('products.show', $product['slug']) }}">{{ $product['name'] }}</a>
                                        
                                        <div class="d-flex mt-2 flex-column flex-md-row">
                                            <div class="mr-md-2 text-nowrap">
                                                Unit Price: {{ $product['price'] }}
                                            </div>
                                            <div class="ml-md-2 text-nowrap">
                                                Total Price: {{ $product['price'] * $product['quantity'] }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-number product__quantity">
                                            <input type="number" id="quantity-{{ $product['id'] }}"
                                                class="form-control input-number__input"
                                                name="quantity[{{ $product['id'] }}]"
                                                value="{{ old('quantity.' . $product['id'], $product['quantity']) }}"
                                                min="1" readonly style="border-radius: 2px;"
                                            >
                                            <div class="input-number__add" wire:click="increaseQuantity({{$product['id']}})">

                                            </div>
                                            <div class="input-number__sub" wire:click="decreaseQuantity({{$product['id']}})">

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
                <h5 class="card-title">Your Order</h5>
            </div>
            <div class="card-body p-3">
                <table class="checkout__totals table table-borderless">
                    <tbody class="checkout__totals-subtotals">
                        <tr>
                            <th>Order Status</th>
                            <td>
                                <select wire:model.defer="order.status" id="status" class="form-control">
                                    @foreach (config('app.orders', []) as $stat)
                                        <option value="{{ $stat }}">{{ $stat }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <td class="checkout-subtotal">{!! theMoney($order->data['subtotal']) !!}</td>
                        </tr>
                        <tr>
                            <th>Delivery Charge</th>
                            <td class="shipping">
                                <input class="shipping form-control"
                                    style="height: auto; padding: 2px 8px;" type="text"
                                    wire:model.debounce.350ms="order.data.shipping_cost"
                                    class="form-control">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="checkout__totals-footer">
                        <tr>
                            <th>Advanced</th>
                            <td>
                                <input style="height: auto; padding: 2px 8px;" type="text"
                                    wire:model.debounce.350ms="order.data.advanced"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>
                                <input style="height: auto; padding: 2px 8px;" type="text"
                                    wire:model.debounce.350ms="order.data.discount"
                                    class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <th class="checkout-subtotal"><strong>{!! theMoney(intval($order->data['subtotal']) + intval($order->data['shipping_cost']) - intval($order->data['advanced'] ?? 0) - intval($order->data['discount'] ?? 0)) !!}</strong></td>
                        </tr>
                        <tr>
                            <th>Note <small>(Optional)</small></th>
                            <td>
                                <div class="form-group">
                                    <x-textarea name="note" wire:model.defer="order.note" rows="4"></x-textarea>
                                    <x-error field="note" />
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <button type="submit" wire:click="updateOrder"
                    class="btn btn-primary btn-xl btn-block">Update</button>
            </div>
        </div>
        @if($order->exists)
        <?php
            function getData($data) {
                if (isset($data['data'])) {
                    $data = array_merge($data, $data['data']);
                    unset($data['data']);
                }
                return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
        ?>
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
                <h5 class="card-title">Activities</h5>
            </div>
            <div class="card-body p-3">
                {{-- Accordion --}}
                <div id="accordion">
                    @foreach($order->activities()->latest()->get() as $activity)
                        <div class="card rounded-0 shadow-sm mb-1">
                            <div class="card-header px-3 py-2" id="heading{{ $activity->id }}">
                                <a class="text-dark" data-toggle="collapse" href="#collapse-{{$activity->id}}">
                                    <div class="border-bottom pb-1 mb-1 text-primary">{{ $activity->description }}</div>
                                    <div class="d-flex justify-content-between">
                                        <div><i class="fa fa-user mr-1"></i>{{ $activity->causer->name ?? 'System' }}</div>
                                        <div><i class="fa fa-clock-o mr-1"></i>{{ $activity->created_at->format('d-M-Y h:i A') }}</div>
                                    </div>
                                </a>
                            </div>

                            <div id="collapse-{{$activity->id}}" class="collapse" data-parent="#accordion">
                                <div class="card-body p-3">
                                    <table class="table table-responsive">
                                        <tbody>
                                            @if($activity->changes['old'] ?? false)
                                            <tr>
                                                <th class="text-center">OLD</th>
                                                <th class="text-center">NEW</th>
                                            </tr>
                                            @endif
                                            <tr>
                                                @if($activity->changes['old'] ?? false)
                                                <td>
                                                    <pre><div class="language-php">{{ getData($activity->changes['old'] ?? []) }}</div></pre>
                                                </td>
                                                @endif
                                                <td>
                                                    <pre><div class="language-php">{{ getData($activity->changes['attributes']) }}</div></pre>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>