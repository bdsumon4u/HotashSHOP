<div class="row">
    <div class="col-12 col-md-8 pr-1">
        <div class="card mb-lg-0">
            <div class="card-body p-3">
                <h4 class="card-title border text-success" style="background: #eee; padding: 2px 10px;">
                    নিচের তথ্যগুলো সঠিকভাবে পূরণ করে কনফার্ম অর্ডার বাটনে ক্লিক করুন।
                </h4>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>আপনার নাম:</label>
                    </div>
                    <div class="form-group col-md-9">
                        <x-input name="name" wire:model.defer="name" placeholder="এখানে আপনার নাম লিখুন।" />
                        <x-error field="name" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>মোবাইল নম্বর:</label>
                    </div>
                    <div class="form-group col-md-9">
                        <x-input name="phone" wire:model.defer="phone" placeholder="+880" />
                        <x-error field="phone" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="d-block"><label>ডেলিভারি এরিয়া: <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group col-md-9">
                        <div class="form-control @error('shipping') is-invalid @enderror h-auto">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" wire:model="shipping" class="custom-control-input" id="inside-dhaka" name="shipping" value="Inside Dhaka">
                                <label class="custom-control-label" for="inside-dhaka">ঢাকা শহর</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" wire:model="shipping" class="custom-control-input" id="outside-dhaka" name="shipping" value="Outside Dhaka">
                                <label class="custom-control-label" for="outside-dhaka">ঢাকার বাইরে</label>
                            </div>
                        </div>
                        <x-error field="shipping" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>আপনার ঠিকানা:</label>
                    </div>
                    <div class="form-group col-md-9">
                        <x-textarea name="address" wire:model.defer="address" placeholder="এখানে আপনার পুরো ঠিকানা লিখুন।"></x-textarea>
                        <x-error field="address" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>নোট (অপশনাল):</label>
                    </div>
                    <div class="form-group col-md-9">
                        <x-textarea name="note" wire:model.defer="note" placeholder="আপনি চাইলে কোন নোট লিখতে পারেন।"></x-textarea>
                        <x-error field="note" />
                    </div>
                </div>
            </div>
            <div class="card-divider d-md-none"></div>
            <div class="card-body d-md-none">
                <h3 class="card-title mb-0">Your Order</h3>
                <div class="ordered-products"></div>
                <table class="checkout__totals">
                    <tbody class="checkout__totals-subtotals">
                        <tr>
                            <th>Subtotal</th>
                            <td class="checkout-subtotal">{!!  theMoney($subtotal)  !!}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td class="shipping">{!! $shipping_cost ? theMoney($shipping_cost) : 'FREE' !!}</td>
                        </tr>
                    </tbody>
                    <tfoot class="checkout__totals-footer">
                        <tr>
                            <th>Total</th>
                            <td>{!!  theMoney($total)  !!}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="checkout__agree form-group">
                    <div class="form-check">
                        <span class="form-check-input input-check">
                            <span class="input-check__body">
                                <input class="input-check__input" type="checkbox" id="checkout-terms-mobile" checked>
                                <span class="input-check__box"></span>
                                <svg class="input-check__icon" width="9px" height="7px">
                                    <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                </svg>
                            </span>
                        </span>
                        <label class="form-check-label" for="checkout-terms-mobile">I agree to the <span class="text-info" target="_blank" href="javascript:void(0);">terms and conditions</span>*</label>
                    </div>
                </div>
                <button type="button" wire:click="checkout" class="btn btn-primary btn-xl btn-block text-white">কনফার্ম অর্ডার</button>
            </div>
            <div class="card-divider"></div>
            <div class="card-body p-1">
                <h4 class="p-2">Product Overview</h4>
                @include('partials.cart-table')
            </div>
        </div>
    </div>
    <div class="d-none d-md-block col-12 col-md-4 pl-1 mt-4 mt-lg-0">
        <div class="card mb-0">
            <div class="card-body">
                <h3 class="card-title">Your Order</h3>
                <div class="ordered-products"></div>
                <table class="checkout__totals">
                    <tbody class="checkout__totals-subtotals">
                        <tr>
                            <th>Subtotal</th>
                            <td class="checkout-subtotal desktop">{!!  theMoney($subtotal)  !!}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td class="shipping">{!! $shipping_cost ? theMoney($shipping_cost) : 'FREE' !!}</td>
                        </tr>
                    </tbody>
                    <tfoot class="checkout__totals-footer">
                        <tr>
                            <th>Total</th>
                            <td>{!!  theMoney($total)  !!}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-none d-md-block">
                    <div class="checkout__agree form-group">
                        <div class="form-check">
                            <span class="form-check-input input-check">
                                <span class="input-check__body">
                                    <input class="input-check__input" type="checkbox" id="checkout-terms-desktop" checked>
                                    <span class="input-check__box"></span>
                                    <svg class="input-check__icon" width="9px" height="7px">
                                        <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                    </svg>
                                </span>
                            </span>
                            <label class="form-check-label" for="checkout-terms-desktop">I agree to the <span class="text-info" target="_blank" href="javascript:void(0);">terms and conditions</span>*</label>
                        </div>
                    </div>
                    <button type="button" wire:click="checkout" class="btn btn-primary btn-xl btn-block text-white">কনফার্ম অর্ডার</button>
                </div>
            </div>
        </div>
    </div>
</div>