<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Page Header -->
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="card-title mb-0">Invoice Management</h5>
      <div class="card-tools">
        <a href="<?php echo site_url('Invoice/add'); ?>" class="btn btn-primary btn-sm">
          <i class="ti ti-plus me-1"></i>Create New Invoice
        </a>
      </div>
    </div>
  </div>

  <!-- Invoice & Orders Tabs -->
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-invoice" aria-controls="navs-justified-invoice" aria-selected="true">
            <i class="ti ti-file-invoice-dollar me-1"></i>Invoices
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-orders" aria-controls="navs-justified-orders" aria-selected="false">
            <i class="ti ti-shopping-cart me-1"></i>Convert Orders to Invoices
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content">

        <!-- Invoices Tab -->
        <div id="navs-justified-invoice" class="tab-pane fade show active" role="tabpanel">
          <div class="card-datatable table-responsive">
            <table class="datatables-invoice table border-top">
              <thead>
                <tr>
                  <th></th>
                  <th>Invoice No</th>
                  <th>Invoice Date</th>
                  <th>Customer Name</th>
                  <th>Customer Mobile</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

        <!-- Orders Tab -->
        <div id="navs-justified-orders" class="tab-pane fade" role="tabpanel">
          <div class="card-datatable table-responsive">
            <table class="datatables-orders table border-top">
              <thead>
                <tr>
                  <th></th>
                  <th>Order No</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Mobile</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
