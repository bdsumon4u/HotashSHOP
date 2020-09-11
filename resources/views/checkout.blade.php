@extends('layouts.yellow.master')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/')                => 'Home',
        route('products.index') => 'Products',
        route('cart')           => 'Cart',
    ],
    'active' => 'Checkout',
    'page_title' => 'Checkout'
])

<div class="checkout block">
    <div class="container">
        <x-form :action="route('post-checkout')" method="POST">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="alert alert-lg alert-primary">Returning customer? <a href="#">Click here to login</a></div>
                </div>
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="card mb-lg-0">
                        <div class="card-body">
                            <h3 class="card-title">Billing details</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <x-label for="name">Name</x-label>
                                    <x-input name="name" placeholder="Type your name here" />
                                    <x-error field="name" />
                                </div>
                                <div class="form-group col-md-6">
                                    <x-label for="phone">Phone</x-label>
                                    <x-input name="phone" placeholder="Type your phone number here" />
                                    <x-error field="phone" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <x-label for="email">Email address (Optional)</x-label>
                                    <x-input type="email" name="email" placeholder="Email address" />
                                    <x-error field="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <x-label for="address">Address</x-label>
                                <x-input name="address" placeholder="Address" />
                                <x-error field="address" />
                            </div>
                            <div class="form-group">
                                <label class="d-block">Shipping Area</label>
                                <div class="form-control @error('shipping') is-invalid @enderror">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="inside-dhaka" name="shipping" value="Inside Dhaka" data-val="50">
                                        <label class="custom-control-label" for="inside-dhaka">Inside Dhaka</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="outside-dhaka" name="shipping" value="Outside Dhaka" data-val="100">
                                        <label class="custom-control-label" for="outside-dhaka">Outside Dhaka</label>
                                    </div>
                                </div>
                                <x-error field="shipping" />
                            </div>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <h3 class="card-title">Shipping Details</h3>
                            <div class="form-group">
                                <x-label for="note">Order notes <span class="text-muted">(Optional)</span></x-label>
                                <x-textarea name="note" rows="4"></x-textarea>
                                <x-error field="note" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h3 class="card-title">Your Order</h3>
                            <div class="ordered-products"></div>
                            <table class="checkout__totals">
                                <tbody class="checkout__totals-subtotals">
                                    <tr>
                                        <th>Subtotal</th>
                                        <td class="checkout-subtotal">$ <span>0</span></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td class="shipping">$ <span>0</span></td>
                                    </tr>
                                </tbody>
                                <tfoot class="checkout__totals-footer">
                                    <tr>
                                        <th>Total</th>
                                        <td>$ <span>0</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="checkout__agree form-group">
                                <div class="form-check">
                                    <span class="form-check-input input-check">
                                        <span class="input-check__body">
                                            <input class="input-check__input" type="checkbox" id="checkout-terms">
                                            <span class="input-check__box"></span>
                                            <svg class="input-check__icon" width="9px" height="7px">
                                                <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                            </svg>
                                        </span>
                                    </span>
                                    <label class="form-check-label" for="checkout-terms">I have read and agree to the website <a target="_blank" href="terms-and-conditions.html">terms and conditions</a>*</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-xl btn-block">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </x-form>
    </div>
</div>
@endsection