var product = {};

product.init = function () {

};

product.listing = function () {
    var dtTaxTable = $('.datatables-product'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'Product/list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Users List datatable
    if (dtTaxTable.length) {
        product.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'Product/list', // JSON file to add data
            columns: [
                // columns according to JSON email, username, full_name, mobile, active
                { data: '' },
                { data: 'code' },
                { data: 'name' },
                { data: 'brand_name' },
                { data: 'category_name' },
                { data: 'unit_id' },
                { data: 'stock' },
                { data: 'min_order_qty' },
                { data: 'purchase_price' },
                { data: 'sales_price' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return full.code;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full.name;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.brand_name ? full.brand_name : 'N/A';
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.category_name ? full.category_name : 'N/A';
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return full.unit_id ? full.unit_id : 'N/A';
                    }
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        return full.stock;
                    }
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        return full.min_order_qty;
                    }
                },
                {
                    targets: 8,
                    render: function (data, type, full, meta) {
                        return full.purchase_price;
                    }
                },
                {
                    targets: 9,
                    render: function (data, type, full, meta) {
                        return full.sales_price;
                    }
                },
                {
                    targets: 10,
                    render: function (data, type, full, meta) {
                        var $status = full.status;

                        var status_index = 0;
                        if ($status == 'ACTIVE') {
                            status_index = 2;
                        } else if ($status == 'INACTIVE') {
                            status_index = 3;
                        } else {
                            status_index = 1;
                        }
                        return (
                            '<span class="badge ' +
                            statusObj[status_index].class +
                            '" text-capitalized>' +
                            statusObj[status_index].title +
                            '</span>'
                        );
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var product_id = full.id;
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<a href="'+hdn_site_url+'Product/view_product/' + product_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-eye"></i></a>' +
                            '<a href="'+hdn_site_url+'Product/update_product/' + product_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-edit"></i></a>' +
                            '<a href="'+hdn_site_url+'Product/delete_product/' + product_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-trash ti-sm mx-2"></i></a>' +
                            '</div>'
                        );
                    }
                }
            ],
            createdRow: function (row, data, index) {
                $(row).addClass('user_row_id_'+data.id);
            },
            order: [[1, 'desc']],
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_product_btn">>>' +
                '>t' +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // For responsive popup
            responsive: {
                details: {
                    type: 'column'
                }
            },
            initComplete: function () {
                var select = $(
                    '<a href="'+hdn_site_url+'Product/add" class="btn btn-primary mb-1 text-nowrap add-new-unit waves-effect waves-light" fdprocessedid="j3r068">Add New Product</a>')
                    .appendTo('.add_product_btn');
            }
        });
    }
    // Delete Record
    $('.datatables-product tbody').on('click', '.delete-record', function () {
        dtTax.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
};
