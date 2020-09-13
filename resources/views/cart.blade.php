@extends('layouts.yellow.master')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/')                => 'Home',
        route('products.index') => 'Products',
    ],
    'active' => 'Cart',
    'page_title' => 'Cart'
])

<div class="cart block">
    <div class="container">
        <table class="cart__table cart-table my-2">
            <thead class="cart-table__head">
                <tr class="cart-table__row">
                    <th class="cart-table__column cart-table__column--image">Image</th>
                    <th class="cart-table__column cart-table__column--product">Product</th>
                    <th class="cart-table__column cart-table__column--price">Price</th>
                    <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                    <th class="cart-table__column cart-table__column--total">Total</th>
                    <th class="cart-table__column cart-table__column--remove"></th>
                </tr>
            </thead>
            <tbody class="cart-table__body">
                
            </tbody>
        </table>
        <div class="cart__actions">
            <div class="cart__buttons ml-auto">
                <a href="{{ route('products.index') }}" class="btn btn-light">Continue Shopping</a>
                <a href="#" class="btn btn-primary cart__update-button">Update Cart</a>
            </div>
        </div>
        <div class="row justify-content-end pt-5">
            <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cart Totals</h3>
                        <table class="cart__totals">
                            <thead class="cart__totals-header">
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="cart-subtotal">$ <span>0</span></td>
                                </tr>
                            </thead>
                            <tbody class="cart__totals-body">
                                <tr>
                                    <th>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="inside-dhaka" name="shipping" value="Inside Dhaka" data-val="50">
                                            <label class="custom-control-label" for="inside-dhaka">Inside Dhaka</label>
                                        </div>
                                    </th>
                                    <td>$ <span>50</span></td>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="outside-dhaka" name="shipping" value="Outside Dhaka" data-val="100">
                                            <label class="custom-control-label" for="outside-dhaka">Outside Dhaka</label>
                                        </div>
                                    </th>
                                    <td>$ <span>100</span></td>
                                </tr>
                            </tbody>
                            <tfoot class="cart__totals-footer">
                                <tr>
                                    <th>Total</th>
                                    <td>$ <span>0</span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection