var sales = {};

sales.listing = function () {
    var dtTaxTable = $('.datatables-sales'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'Sales/list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Sales List datatable
    if (dtTaxTable.length) {
        sales.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'Sales/list', // JSON file to add data
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'order_no' },
                { data: 'date' },
                { data: null, render: function(data) { return data.first_name + ' ' + data.last_name; } },
                { data: 'mobile' },
                { data: 'total' },
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
                        return '<a href="' + hdn_site_url + 'Sales/update/' + full.id + '">' + full.order_no + '</a>';
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return new Date(full.date).toLocaleDateString();
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.first_name + ' ' + full.last_name;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.mobile || 'N/A';
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return '₹' + parseFloat(full.total).toFixed(2);
                    }
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        var $status = full.status;

                        var statusClass = '';
                        if ($status == 'DELIVERED') {
                            statusClass = 'bg-label-success';
                        } else if ($status == 'ORDERED') {
                            statusClass = 'bg-label-primary';
                        } else if ($status == 'CANCELED') {
                            statusClass = 'bg-label-danger';
                        } else {
                            statusClass = 'bg-label-secondary';
                        }
                        return (
                            '<span class="badge ' + statusClass + '" text-capitalized>' + $status + '</span>'
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
                        var sale_id = full.id;
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<a href="'+hdn_site_url+'Sales/update/' + sale_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-edit"></i></a>' +
                            '<a href="'+hdn_site_url+'Sales/delete/' + sale_id + '" class="btn btn-sm btn-icon me-2"><i class="ti ti-trash ti-sm"></i></a>' +
                            '</div>'
                        );
                    }
                }
            ],
            createdRow: function (row, data, index) {
                $(row).addClass('sale_row_id_'+data.id);
            },
            order: [[2, 'desc']],
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_sale_btn">>>' +
                '>t' +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Sales..'
            },
            // For responsive popup
            responsive: {
                details: {
                    type: 'column'
                }
            },
            initComplete: function () {
                var select = $(
                    '<a href="'+hdn_site_url+'Sales/add" class="btn btn-primary mb-1 text-nowrap add-new-sale waves-effect waves-light" fdprocessedid="j3r068">Add New Sale</a>')
                    .appendTo('.add_sale_btn');
            }
        });
    }
};