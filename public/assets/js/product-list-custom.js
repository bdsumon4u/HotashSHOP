"use strict";
(function($) {
    "use strict";
    var apiEnd = $('#product-table').data('url');
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: apiEnd,
        columns: [
           { data: 'image' },
           { data: 'name', name: 'name' },
           { data: 'pricing', name: 'price' },
           { data: 'stock', name: 'stock_count' },
           { data: 'actions' },
        ],
        order: [
           [1, 'desc']
        ],
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    $(document).on('click', '[data-action="delete"]', function (e) {
        e.preventDefault();
        if (! confirm('Are you sure to delete?')) {
            return;
        }

        $.ajax({
            url: $(this).attr('href'),
            type: 'DELETE',
            dataType: 'json',
        }).always(function (data) {
            $('#product-table').DataTable().draw(false);
        });
    })
})(jQuery);