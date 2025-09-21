/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {
  // Get site URL
  var site_url = $('#hdn_site_url').val() || '';

  // Variable declaration for tables
  var dt_invoice_table = $('.datatables-invoice');
  var dt_orders_table = $('.datatables-orders');

  // Orders datatable
  if (dt_orders_table.length) {
    var dt_orders = dt_orders_table.DataTable({
      ajax: {
        url: site_url + 'Invoice/get_orders_list',
        type: 'GET',
        dataSrc: 'data'
      },
      columns: [
        {
          data: null,
          render: function(data, type, row) {
            return '<input type="checkbox" class="form-check-input">';
          },
          orderable: false,
          width: '30px'
        },
        { data: 'order_no' },
        { data: 'date' },
        {
          data: null,
          render: function(data, type, row) {
            return (row.first_name + ' ' + (row.last_name || ''));
          }
        },
        { data: 'mobile' },
        {
          data: 'total',
          render: function(data, type, row) {
            return '₹' + parseFloat(data).toLocaleString('en-IN', { minimumFractionDigits: 2 });
          }
        },
        {
          data: 'status',
          render: function(data, type, row) {
            const statusMap = {
              'DRAFT': '<span class="badge bg-secondary">Draft</span>',
              'ORDERED': '<span class="badge bg-info">Ordered</span>',
              'DELIVERED': '<span class="badge bg-success">Delivered</span>',
              'CANCELED': '<span class="badge bg-danger">Canceled</span>'
            };
            return statusMap[row.status] || row.status;
          }
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
              <a href="` + site_url + `Invoice/convert_order_to_invoice/` + row.id + `"
                 class="btn btn-sm btn-primary"
                 onclick="return confirm('Are you sure you want to convert this order to invoice?')">
                <i class="ti ti-refresh me-1"></i>Convert to Invoice
              </a>
            `;
          },
          orderable: false
        }
      ],
      responsive: true,
      paging: true,
      info: true,
      ordering: true,
      searching: true
    });
  }

  // Invoice datatable
  if (dt_invoice_table.length) {
    var dt_invoice = dt_invoice_table.DataTable({
      ajax: {
        url: site_url + 'Invoice/list',
        type: 'GET',
        dataSrc: 'data'
      },
      columns: [
        // columns according to JSON
        {
          data: null,
          render: function(data, type, row) {
            return '<input type="checkbox" class="form-check-input">';
          },
          orderable: false,
          width: '30px'
        },
        { data: 'order_no' },
        { data: 'date' },
        {
          data: null,
          render: function(data, type, row) {
            return ((row ? (row.first_name || '') : '') + ' ' + (row ? (row.last_name || '') : '')).trim();
          }
        },
        { data: 'mobile' },
        {
          data: 'total',
          render: function(data, type, row) {
            return '₹' + parseFloat(data).toLocaleString('en-IN', { minimumFractionDigits: 2 });
          }
        },
        {
          data: 'status',
          render: function(data, type, row) {
            var statusMap = {
              'DRAFT': '<span class="badge bg-secondary">Draft</span>',
              'ISSUED': '<span class="badge bg-primary">Issued</span>',
              'PAID': '<span class="badge bg-success">Paid</span>',
              'CANCELLED': '<span class="badge bg-danger">Cancelled</span>'
            };
            return statusMap[row.status] || row.status;
          }
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
              <a class="btn btn-sm btn-outline-primary me-1" href="` + site_url + `Invoice/view/` + row.id + `" data-bs-toggle="tooltip" title="View">
              <i class="ti ti-eye"></i>
              </a>
              <a class="btn btn-sm btn-outline-success me-1" href="` + site_url + `Invoice/export_pdf/` + row.id + `" target="_blank" data-bs-toggle="tooltip" title="Download PDF">
              <i class="ti ti-download"></i>
              </a>
              <a class="btn btn-sm btn-outline-warning" href="` + site_url + `Invoice/update/` + row.id + `" data-bs-toggle="tooltip" title="Edit">
              <i class="ti ti-edit"></i>
              </a>
            `;
          },
          orderable: false
        }
      ],
      columnDefs: [
        {
          className: 'control',
          responsivePriority: 1,
          targets: 0
        }
      ],
      order: [[1, 'desc']],
      dom: '<"table-responsive"t><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>',
    });
  }

  // On each datatable draw, initialize tooltip
  dt_invoice_table.on('draw.dt', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body
      });
    });
  });

  // Delete Record
  $('.datatables-invoice tbody').on('click', '.delete-record', function () {
    dt_invoice.row($(this).parents('tr')).remove().draw();
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
