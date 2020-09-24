@extends('layouts.yellow.master')

@title('Cart Details')

@push('styles')
<style>
    .btn {
        height: auto;
    }
</style>
@endpush

@content

@include('partials.page-header', [
    'paths' => [
        url('/')                => 'Home',
        route('products.index') => 'Products',
    ],
    'active' => 'Cart Details',
    'page_title' => 'Cart Details'
])

<div class="cart block">
    <div class="container">
        <div class="row justify-content-end pt-5">
            <div class="col-12 col-md-8">
                <div class="table-responsive">
                    <table class="cart__table cart-table">
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
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cart Details</h3>
                        <table class="cart__totals">
                            <thead class="cart__totals-header">
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="cart-subtotal">{!!  theMoney(0)  !!}</td>
                                </tr>
                            </thead>
                        </table>
                        <a class="btn btn-primary btn-xl btn-block cart__checkout-button px-2" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection