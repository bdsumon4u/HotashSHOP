<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
        <thead>
            <tr>
                <th style="min-width: 50px;">SI</th>
                <th style="min-width: 120px;">Name</th>
                <th style="min-width: 100px;">Quantity</th>
                <th style="min-width: 100px;">Price</th>
            </tr>
        </thead>
        @php $total = 0; $amount = 0; @endphp
        <tbody>
            @foreach ($products as $name => $product)
                @php $total += $product['quantity']; $amount += $product['total']; @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $name }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th colspan="2" class="text-right">Total</th>
            <th>{{ $total }}</th>
            <th>{{ $amount }}</th>
        </tfoot>
    </table>
</div>