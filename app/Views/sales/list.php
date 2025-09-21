<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Sales List Table -->
  <div class="card">

    <div class="card-datatable table-responsive">
      <table class="datatables-sales table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Sale No</th>
            <th>Sale Date</th>
            <th>Customer Name</th>
            <th>Customer Mobile</th>
            <th>Amount</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Add Sale Button -->
    <div class="d-flex justify-content-end mt-3">
      <a href="<?php echo site_url('Sales/add'); ?>" class="btn btn-primary">
        <i class="ti ti-plus me-1"></i>Add Sale
      </a>
    </div>
  </div>
</div>