var setting = {};
setting.dtTax = [];


setting.view_tax = function (tax_id) {
    var site_url = $("#hdn_site_url").val();
    var data = { tax_id: tax_id };
    $.ajax({
        url: site_url + 'Site/view_tax',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        async: true,
        success: function (response) {
            if (response.status == 200) {
                var htmlOutput = '';
                htmlOutput += '<table class="table">';
                htmlOutput += '<tbody>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="1">';
                htmlOutput += '<td>Tax Name</td>';
                htmlOutput += '<td>';
                htmlOutput += response.data.name;
                htmlOutput += '</td>';
                htmlOutput += '</tr>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="2">';
                htmlOutput += '<td>Percentage</td>';
                htmlOutput += '<td>';
                htmlOutput += '<div class="d-flex justify-content-start align-items-center customer-name">';
                htmlOutput += response.data.percentage;
                htmlOutput += '</div>';
                htmlOutput += '</td>';
                htmlOutput += '</tr>';

                htmlOutput += '<tr data-dt-row="8" data-dt-column="3">';
                htmlOutput += '<td>Register Number</td>';
                htmlOutput += '<td><span class="text-nowrap">' + response.data.reg_no + '</span></td>';
                htmlOutput += '</tr>';

                htmlOutput += '<tr data-dt-row="8" data-dt-column="4">';
                htmlOutput += '<td>Default Tax</td>';
                htmlOutput += '<td><span class="text-nowrap">' + response.data.default_tax + '</span></td>';
                htmlOutput += '</tr>';

                htmlOutput += '<tr data-dt-row="8" data-dt-column="5">';
                htmlOutput += '<td>Created at</td>';
                htmlOutput += '<td><span class="text-nowrap">' + response.data.created_at + '</span></td>';
                htmlOutput += '</tr>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="6">';
                htmlOutput += '<td>Status</td>';

                if (response.data.status = 'Active') {
                    var status_class = 'bg-label-success';
                } else {
                    var status_class = 'bg-label-danger';
                }
                htmlOutput += '<td><span class="badge ' + status_class + '" text-capitalize="">' + response.data.status + '</span></td>';
                htmlOutput += '</tr>';

                htmlOutput += '</tbody>';
                htmlOutput += '</table>';

                $(".tax_view_content").html(htmlOutput);
            } else {
                $.each(response.message, function (index, value) {
                    common.toastr_popup('error_msg', value.required);
                });
            }

        },
        complete: function () {

        },
        error: function (xhr, status, error) {

        }
    });
};

setting.view_unit = function (unit_id) {
    var site_url = $("#hdn_site_url").val();
    var data = { unit_id: unit_id };
    $.ajax({
        url: site_url + 'Site/view_unit',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        async: true,
        success: function (response) {
            if (response.status == 200) {
                var htmlOutput = '';
                htmlOutput += '<table class="table">';
                htmlOutput += '<tbody>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="1">';
                htmlOutput += '<td>Unit Name</td>';
                htmlOutput += '<td>';
                htmlOutput += response.data.name;
                htmlOutput += '</td>';
                htmlOutput += '</tr>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="2">';
                htmlOutput += '<td>Description</td>';
                htmlOutput += '<td>';
                htmlOutput += '<div class="d-flex justify-content-start align-items-center customer-name">';
                htmlOutput += response.data.description;
                htmlOutput += '</div>';
                htmlOutput += '</td>';
                htmlOutput += '</tr>';

               

                htmlOutput += '<tr data-dt-row="8" data-dt-column="5">';
                htmlOutput += '<td>Created at</td>';
                htmlOutput += '<td><span class="text-nowrap">' + response.data.created_at + '</span></td>';
                htmlOutput += '</tr>';
                htmlOutput += '<tr data-dt-row="8" data-dt-column="6">';
                htmlOutput += '<td>Status</td>';

                if (response.data.status = 'Active') {
                    var status_class = 'bg-label-success';
                } else {
                    var status_class = 'bg-label-danger';
                }
                htmlOutput += '<td><span class="badge ' + status_class + '" text-capitalize="">' + response.data.status + '</span></td>';
                htmlOutput += '</tr>';

                htmlOutput += '</tbody>';
                htmlOutput += '</table>';

                $(".unit_view_content").html(htmlOutput);
            } else {
                $.each(response.message, function (index, value) {
                    common.toastr_popup('error_msg', value.required);
                });
            }

        },
        complete: function () {

        },
        error: function (xhr, status, error) {

        }
    });
};


setting.edit_tax = function (tax_id) {
    $(".tax-title").html('Edit Tax');
    var site_url = $("#hdn_site_url").val();
    var data = { tax_id: tax_id };
    $.ajax({
        url: site_url + 'Site/view_tax',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        async: true,
        success: function (response) {
            $('#addTaxForm').trigger("reset");
            if (response.status == 200) {
                $("#hdn_tax_id").val(tax_id);
                $("#tax_name").val(response.data.name);
                $("#tax_percentage").val(response.data.percentage);
                $("#tax_reg_no").val(response.data.reg_no);
                if(response.data.default_tax=='No'){
                    $('#default_tax').prop('checked',false);
                }else{
                    $('#default_tax').prop('checked',true);
                }
                if(response.data.status=='Inactive'){
                    $('#tax_status').prop('checked',false);
                }else{
                    $('#tax_status').prop('checked',true);
                }

            } else {
                $.each(response.message, function (index, value) {
                    common.toastr_popup('error_msg', value.required);
                });
            }
        },
        complete: function () {

        },
        error: function (xhr, status, error) {

        }
    });
};

setting.edit_unit = function (unit_id) {
    $(".unit-title").html('Edit Unit');
    var site_url = $("#hdn_site_url").val();
    var data = { unit_id: unit_id };
    $.ajax({
        url: site_url + 'Site/view_unit',
        type: 'POST',
        dataType: 'JSON',
        data: JSON.stringify(data),
        contentType: 'application/json; charset=utf-8',
        async: true,
        success: function (response) {
            $('#addUnitForm').trigger("reset");
            if (response.status == 200) {
                $("#hdn_unit_id").val(unit_id);
                $("#unit_name").val(response.data.name);
                $("#unit_description").val(response.data.description);
                
                if(response.data.status=='Inactive'){
                    $('#unit_status').prop('checked',false);
                }else{
                    $('#unit_status').prop('checked',true);
                }

            } else {
                $.each(response.message, function (index, value) {
                    common.toastr_popup('error_msg', value.required);
                });
            }
        },
        complete: function () {

        },
        error: function (xhr, status, error) {

        }
    });
};

setting.delete_tax = function (tax_id) {
    var site_url = $("#hdn_site_url").val();
    var data = {tax_id:tax_id};
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: site_url + 'Site/delete_tax',
                type: 'POST',
                dataType: 'JSON',
                data: JSON.stringify(data),
                contentType: 'application/json; charset=utf-8',
                async: true,
                success: function (response) {
                    if (response.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                        $(".tax_row_id_"+tax_id).remove().draw();
                    } else {
                        $.each(response.message, function (index, value) {
                            common.toastr_popup('error_msg', value.required);
                        });
                    }
                },
                complete: function () {

                },
                error: function (xhr, status, error) {

                }
            });
        }
    });
};

setting.tax_listing = function () {
    var dtTaxTable = $('.datatables-taxes'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'Site/tax_list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Users List datatable
    if (dtTaxTable.length) {
        setting.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'Site/tax_list', // JSON file to add data
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'name' },
                { data: 'percentage' },
                { data: 'reg_no' },
                { data: 'default_tax' },
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
                        return full['name'];
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full['percentage'];
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $reg_no = full['reg_no'];
                        return '<span class="fw-semibold">' + $reg_no + '</span>';
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $default_tax = full['default_tax'];
                        $default_tax = $default_tax.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        });
                        return '<span class="fw-semibold">' + $default_tax + '</span>';
                    }
                },
                {
                    targets: 5,
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
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var tax_id = full['id'];
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" data-bs-target="#viewTaxModal" onclick="setting.view_tax(' + tax_id + ');" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="setting.edit_tax(' + tax_id + ');" data-bs-target="#addTaxModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="setting.delete_tax(' + tax_id + ');" ><i class="ti ti-trash ti-sm mx-2"></i></button>' +
                            '</div>'
                        );
                    }
                }
            ],
            createdRow: function (row, data, index) {
                $(row).addClass('tax_row_id_'+data.id);
            },
            order: [[1, 'desc']],
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_tax_btn">>>' +
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
                            return 'Details of ' + data['full_name'];
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
                    '<button data-bs-target="#addTaxModal" data-bs-toggle="modal" class="btn btn-primary mb-1 text-nowrap add-new-tax waves-effect waves-light" fdprocessedid="j3r068">Add New Tax</button>')
                    .appendTo('.add_tax_btn');
            }
        });
    }
    // Delete Record
    $('.datatables-taxes tbody').on('click', '.delete-record', function () {
        dtTax.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
};

setting.unit_listing = function () {
    var dtTaxTable = $('.datatables-units'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Inactive', class: 'bg-label-secondary' }
        };

    var userView = 'Site/unit_list';
    var hdn_site_url = $("#hdn_site_url").val();
    // Users List datatable
    if (dtTaxTable.length) {
        setting.dtTax = dtTaxTable.DataTable({
            ajax: hdn_site_url + 'Site/unit_list', // JSON file to add data
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'name' },
                { data: 'description' },
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
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var unit_id = full['id'];
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" data-bs-target="#viewUnitModal" onclick="setting.view_unit(' + unit_id + ');" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="setting.edit_unit(' + unit_id + ');" data-bs-target="#addUnitModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-edit"></i></button>' +
                            '<button type="button" class="btn btn-sm btn-icon me-2" onclick="setting.delete_unit(' + unit_id + ');" ><i class="ti ti-trash ti-sm mx-2"></i></button>' +
                            '</div>'
                        );
                    }
                }
            ],
            createdRow: function (row, data, index) {
                $(row).addClass('unit_row_id_'+data.id);
            },
            order: [[1, 'desc']],
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"add_unit_btn">>>' +
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
                            return 'Details of ' + data['full_name'];
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
                    '<button data-bs-target="#addUnitModal" data-bs-toggle="modal" class="btn btn-primary mb-1 text-nowrap add-new-unit waves-effect waves-light" fdprocessedid="j3r068">Add New Unit</button>')
                    .appendTo('.add_unit_btn');
            }
        });
    }
    // Delete Record
    $('.datatables-units tbody').on('click', '.delete-record', function () {
        dtTax.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
};