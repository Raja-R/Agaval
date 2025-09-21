<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="card-text text-uppercase">About</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> <span><?php echo $customer_data->name; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span><?php echo $customer_data->status; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-receipt-tax"></i><span class="fw-bold mx-2">GST No:</span> <span><?php echo $customer_data->gst_no; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-receipt-tax"></i><span class="fw-bold mx-2">Tax No:</span> <span><?php echo $customer_data->tax_no; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-calendar-time"></i><span class="fw-bold mx-2">Created at:</span>
              <span><?php echo $customer_data->created_at; ?></span>
            </li>
          </ul>
          <small class="card-text text-uppercase">Contacts</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
              <span><?php echo $customer_data->mobile; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Phone:</span>
              <span><?php echo $customer_data->phone; ?></span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
              <span><?php echo $customer_data->email; ?></span>
            </li>
          </ul>
          <small class="card-text text-uppercase">Address</small>
          <p><?php echo $customer_data->address; ?>, <?php echo $customer_data->city; ?></p>
        </div>
      </div>
      <!--/ About User -->
     
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
      <!-- Activity Timeline -->
      <div class="card card-action mb-4">
        
        <div class="card-body pb-0">
          <ul class="timeline ms-1 mb-0">
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Client Meeting</h6>
                  <small class="text-muted">Today</small>
                </div>
                <p class="mb-2">Project meeting with john @10:15am</p>
                
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-success"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Create a new project for client</h6>
                  <small class="text-muted">2 Day Ago</small>
                </div>
                <p class="mb-0">Add files to new design folder</p>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-danger"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Shared 2 New Project Files</h6>
                  <small class="text-muted">6 Day Ago</small>
                </div>
                
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent border-0">
              <span class="timeline-point timeline-point-info"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Project status updated</h6>
                  <small class="text-muted">10 Day Ago</small>
                </div>
                <p class="mb-0">Woocommerce iOS App Completed</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!--/ Activity Timeline -->

      <!-- Projects table -->
      <div class="card mb-4">
        <div class="card-datatable table-responsive">
          <table class="datatables-projects table border-top">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>Leader</th>
                <th>Team</th>
                <th class="w-px-200">Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!--/ Projects table -->
    </div>
  </div>
</div>