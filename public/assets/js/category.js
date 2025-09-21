var category = {};

category.init = function () {

};

category.listing = function () {
    var dtTaxTable = $('.datatables-category'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'Category/list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Users List datatable
    if (dtTaxTable.length) {
        category.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'Category/list', // JSON file to add data
            columns: [
                // columns according to JSON email, username, full_name, mobile, active
                { data: '' },
                { data: 'Name' },
                { data: 'Description' },
                { data: 'Status' },
                { data: 'Created On' },
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
                    render: function (data, type, full, meta) {
                        return full['name'];
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full['description'];
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $status = full['status'];

                        var status_index = 0;
                        if ($status == 'ACTIVE') {
                            status_index = 2;
                        } else if ($status == 'INACTIVE') {
                            status_index = 1;
                        } else {
                            status_index = 3;
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
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full['created_at'];
                    }
                },
                {
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var product_id = full['id'];
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<a href="'+hdn_site_url+'Category/update/' + product_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-edit"></i></a>' +
                            '<a href="'+hdn_site_url+'Category/delete/' + product_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-trash ti-sm mx-2"></i></a>' +
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
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_category_btn">>>' +
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
                    '<a href="'+hdn_site_url+'Category/add" class="btn btn-primary mb-1 text-nowrap add-new-unit waves-effect waves-light" fdprocessedid="j3r068">Add New Category</a>')
                    .appendTo('.add_category_btn');
            }
        });
    }
    // Delete Record
    $('.datatables-category tbody').on('click', '.delete-record', function () {
        dtTax.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
};

