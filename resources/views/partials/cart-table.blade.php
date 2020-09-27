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