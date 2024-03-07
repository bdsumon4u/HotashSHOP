<div class="col-md-12">
    <div class="row" x-data="{free: {{$free_delivery ?? 0}}, all: {{$free_for_all ?? 0}}}">
        <div class="col-md-6 py-2">
            <div class="d-flex">
                <label for="">Delivery Charge</label>
                <div class="ml-2 custom-control custom-checkbox checkbox-inline">
                    <input type="hidden" name="free_delivery[enabled]" x-model="free" value="0">
                    <input id="free" class="custom-control-input" type="checkbox" wire:model="free_delivery" name="free_delivery[enabled]" x-model="free" value="1">
                    <label for="free" class="custom-control-label">Free Delivery</label>
                </div>
                <div x-show="free" class="ml-2 custom-control custom-checkbox checkbox-inline">
                    <input type="hidden" name="free_delivery[for_all]" x-model="all" value="0">
                    <input id="all" class="custom-control-input" type="checkbox" wire:model="free_for_all" name="free_delivery[for_all]" x-model="all" value="1">
                    <label for="all" class="custom-control-label">For All Products</label>
                </div>
            </div>
            <div x-show="free && !all" class="row px-3">
                <input type="search" wire:model.debounce.250ms="search" id="search"
                    placeholder="Search Product" class="form-control">
                
                @if (session()->has('error'))
                    <strong class="text-danger d-flex align-items-center">{{ session('error') }}</strong>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div x-show="!free || !all" class="row borderr py-2">
                <div class="col-md-6 pr-md-0">
                    <label for="products_page-rows">Inside Dhaka</label>
                    <x-input name="delivery_charge[inside_dhaka]" id="delivery_charge-inside_dhaka" :value="$delivery_charge['inside_dhaka'] ?? config('services.shipping')['Inside Dhaka']" />
                    <x-error field="delivery_charge.inside_dhaka" />
                </div>
                <div class="col-md-6 pl-md-0">
                    <label for="products_page-cols">Outside Dhaka</label>
                    <x-input name="delivery_charge[outside_dhaka]" id="delivery_charge-outside_dhaka" :value="$delivery_charge['outside_dhaka'] ?? config('services.shipping')['Outside Dhaka']" />
                    <x-error field="delivery_charge.outside_dhaka" />
                </div>
            </div>
            <div x-show="free && all" class="row borderr py-2">
                <div class="col-md-6 pr-0">
                    <label for="products_page-rows">Minimum No. of Products</label>
                    <x-input name="free_delivery[min_quantity]" id="free_delivery-min_quantity" :value="$min_quantity ?? false" />
                    <x-error field="free_delivery.min_quantity" />
                </div>
                <div class="col-md-6 pl-0">
                    <label for="products_page-cols">Minimum Total Amount</label>
                    <x-input name="free_delivery[min_amount]" id="free_delivery-min_amount" :value="$min_amount ?? false" />
                    <x-error field="free_delivery.min_amount" />
                </div>
            </div>
        </div>
        <div class="col-md-12" x-show="free && !all">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Min Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset(optional($product->base_image)->src) }}" width="100"
                                        height="100" alt="">
                                </td>
                                <td>
                                    <a class="mb-2 d-block"
                                        href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        wire:click="addProduct({{ $product }})">Enable</button>
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
                                </td>
                                <td>
                                    <div class="input-group">
                                        <button class="btn btn-outline-primary input-group-prepend"
                                            wire:click="decreaseQuantity({{ $product['id'] }})"
                                            type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="text" style="max-width: 100px;"
                                            class="form-control text-center border-primary"
                                            name="free_delivery[products][{{$product['id']}}]"
                                            id="quantity-{{ $product['id'] }}"
                                            wire:model="selectedProducts.{{$product['id']}}.quantity"
                                            readonly
                                        >
                                        <button class="btn btn-outline-primary input-group-append"
                                            wire:click="increaseQuantity({{ $product['id'] }})"
                                            type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
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