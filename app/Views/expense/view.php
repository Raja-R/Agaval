<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="card-text text-uppercase">Expense</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-category-2"></i><span class="fw-bold mx-2">Expense Category:</span> <span><?php echo $expense_data[0]['category_name']; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-calendar-time"></i><span class="fw-bold mx-2">Expense Date:</span> <span><?php echo $expense_data[0]['expense_date']; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-number"></i><span class="fw-bold mx-2">Refference No:</span> <span><?php echo $expense_data[0]['reference_no']; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-user-plus"></i><span class="fw-bold mx-2">Expense For:</span> <span><?php echo $expense_data[0]['expense_for']; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-report-money"></i><span class="fw-bold mx-2">Expense Amount:</span> <span><?php echo $expense_data[0]['expense_amt']; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-calendar-time"></i><span class="fw-bold mx-2">Created at:</span>
              <span><?php echo $expense_data[0]['created_at']; ?></span>
            </li>

            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-note"></i><span class="fw-bold mx-2">Note:</span>
              <span><?php echo $expense_data[0]['note']; ?></span>
            </li>

            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span>
              <span class=" text-capitalize"><?php echo $expense_data[0]['status']; ?></span>
            </li>
          </ul>

        </div>
      </div>
      <!--/ About User -->

    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
      <!-- Activity Timeline -->

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <p class="card-subtitle text-muted mb-1">Expenses for <?php echo $expense_data[0]['category_name']; ?></p>
            
          </div>
          
        </div>
        <div class="card-body">
          <div id="horizontalBarChart"></div>
        </div>
      </div>

      <!--/ Activity Timeline -->

    </div>
  </div>
</div>
