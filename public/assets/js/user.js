var user = {};

user.init = function () {

};
user.add_user = function () {
    var site_url = $("#hdn_site_url").val();
    var data = { fullname: user_fullname, email: user_email, contact: user_contact, role: user_role, username: username, password: password, pass_confirm: pass_confirm };
   

    $.ajax({
        url: site_url + 'user_register',
        type: 'POST',
        dataType: 'JSON',
        data: data,
        async: true,
        success: function (response) {
            $.each(response, function (index,value) {
                toastr.error(value);
            });
        },
        complete: function () {

        },
        error: function (xhr, status, error) {

        }
    });

};

user.listing = function () {
    var dtTaxTable = $('.datatables-users'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'User/user_list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Users List datatable
    if (dtTaxTable.length) {
        user.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'User/user_list', // JSON file to add data
            columns: [
                // columns according to JSON email, username, full_name, mobile, active
                { data: '' },
                { data: 'first_name' },
                { data: 'email' },
                { data: 'mobile' },
                { data: 'active' },
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
                        return full['first_name']+' '+full['last_name'];
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full['email'];
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full['mobile'];
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $status = full['active'];

                        var status_index = 0;
                        if ($status == '1') {
                            status_index = 2;
                        } else if ($status == '0') {
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
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var user_id = full['id'];
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" data-bs-target="#viewUnitModal" onclick="user.view_unit(' + user_id + ');" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="user.edit_unit(' + user_id + ');" data-bs-target="#addUnitModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="user.delete_unit(' + user_id + ');" ><i class="ti ti-trash ti-sm mx-2"></i></button>' +
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
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_user_btn">>>' +
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
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + full['first_name']+' '+full['last_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            },
            initComplete: function () {
                var select = $(
                    '<a href="'+hdn_site_url+'User/add" class="btn btn-primary mb-1 text-nowrap add-new-unit waves-effect waves-light" fdprocessedid="j3r068">Add New User</a>')
                    .appendTo('.add_user_btn');
            }
        });
    }
    // Delete Record
    $('.datatables-users tbody').on('click', '.delete-record', function () {
        dtTax.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
};
