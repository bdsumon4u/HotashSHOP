@extends('layouts.yellow.master')

@title('Order Status')

@content
<div class="block mt-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="order-header">
            <div class="order-header__actions"><a href="{{ route('track-order') }}" class="btn btn-xs btn-secondary">Back to Form</a></div>
            <h5 class="order-header__title">Order #{{ $order->id }}</h5>
            <div class="order-header__subtitle">Was placed on <mark class="order-header__date">{{ $order->created_at->format('d-m-Y') }}</mark> and currently status is <mark class="order-header__status">{{ $order->status }}</mark>.</div>
          </div>
          <div class="card-divider"></div>
          <div class="card-table">
            <div class="table-responsive-sm">
              <table>
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody class="card-table__body card-table__body--merge-rows">
                  @foreach($order->products as $product)
                  <tr>
                    <td><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a> × {{ $product->quantity }}</td>
                    <td>{!! theMoney($product->quantity * $product->price) !!}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tbody class="card-table__body card-table__body--merge-rows">
                  @exp($data = $order->data)
                  <tr>
                    <th>Subtotal</th>
                    <td>{!! theMoney($data->subtotal) !!}</td>
                  </tr>
                  <tr>
                    <th>Shipping</th>
                    <td>{!! theMoney($data->shipping_cost) !!}</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total</th>
                    <td>{!! theMoney($data->subtotal + $data->shipping_cost) !!}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endcontent