@extends('layouts.light.master')
@section('title', 'Orders')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endpush

@section('breadcrumb-title')
<h3>Orders</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Orders</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="orders-table">
            <div class="card rounded-0 shadow-sm">
                <div class="card-header p-3"><strong>All Orders</strong></div>
                <div class="card-body p-3">
                    <div class="table-responive">
                        <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Name</th>
                                    <th>Contacts</th>
                                    <th>Address</th>
                                    <th width="10">Status</th>
                                    <th width="100">Ordered At</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <form action="" method="post" class="delete-form d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endpush

@push('scripts')
<script>
    var table = $('.datatable').DataTable({
        search: [
            {
                bRegex: true,
                bSmart: false,
            },
        ],
        columnDefs: [
            {
                orderable: false,
                searchable: false,
                targets: -1
            },
        ],
        processing: true,
        serverSide: true,
        ajax: "{!! route('api.orders') !!}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'contacts' },
            { data: 'address', name: 'address' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions' },
        ],
        order: [
            [1, 'desc']
        ],
    });

    
    // $('.datatable thead tr').clone(true).appendTo( '.datatable thead' );
    $('.datatable thead tr th').each( function (i) {
        if ($.inArray(i, [0]) != -1) {
            var title = $(this).text();
            $(this).removeClass('sorting').addClass('p-1').html( '<input class="form-control" type="text" placeholder="'+title+'" size="10" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search('^'+ (this.value.length ? this.value : '.*') +'$', true, false)
                        .draw();
                }
            } );
        }
    });

    table.on('draw', function () {
        $(document).on('click', '[data-action="delete"]', function (ev) {
            ev.preventDefault();
            $('.delete-form').attr('action', $(this).attr('href')).submit();
        });
    });
</script>
@endpush