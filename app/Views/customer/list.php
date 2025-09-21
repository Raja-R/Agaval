<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Session</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">21,459</h4>
                <span class="text-success">(+29%)</span>
              </div>
              <span>Total Users</span>
            </div>
            <span class="badge bg-label-primary rounded p-2">
              <i class="ti ti-user ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Paid Users</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">4,567</h4>
                <span class="text-success">(+18%)</span>
              </div>
              <span>Last week analytics </span>
            </div>
            <span class="badge bg-label-danger rounded p-2">
              <i class="ti ti-user-plus ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Active Users</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">19,860</h4>
                <span class="text-danger">(-14%)</span>
              </div>
              <span>Last week analytics</span>
            </div>
            <span class="badge bg-label-success rounded p-2">
              <i class="ti ti-user-check ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Users</span>
              <div class="d-flex align-items-center my-1">
                <h4 class="mb-0 me-2">237</h4>
                <span class="text-success">(+42%)</span>
              </div>
              <span>Last week analytics</span>
            </div>
            <span class="badge bg-label-warning rounded p-2">
              <i class="ti ti-user-exclamation ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Users List Table -->
  <div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title mb-3">Search Filter</h5>
      <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
        <div class="col-md-4 user_role"></div>
        <div class="col-md-4 user_plan"></div>
        <div class="col-md-4 user_status"></div>
      </div>
    </div>
    <div class="card-datatable table-responsive">
      <table class="datatables-customer table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">

        <div class="mb-3">
          <label class="form-label" for="user_fullname">Full Name</label>
          <input type="text" class="form-control" id="user_fullname" placeholder="Full Name" name="user_fullname" aria-label="Full Name" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="user_email" class="form-control" placeholder="example@example.com" aria-label="example@example.com" name="user_email" />
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user_contact">Contact</label>
          <div class="input-group">
            <span class="input-group-text">IN (+91)</span>
            <input type="text" id="user_contact" name="user_contact" class="form-control phone-number-mask" placeholder="9876543210">
          </div>

        </div>


        <div class="mb-3">
          <label class="form-label" for="user_role">User Role</label>
          <select id="user_role" name="user_role" class="form-select">
            <option value="">--Select Role--</option>
            <?php foreach ($role_data as $key => $value) { ?>
              <option value="<?php echo $value->id; ?>"><?php echo $value->description; ?></option>
            <?php } ?>
          </select>
        </div>
        <h6>Account Details</h6>

        <div class="mb-3">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="" autocomplete="off" />
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" aria-label="Password" autocomplete="off">
        </div>

        <div class="mb-3">
          <label for="pass_confirm">Repeat Password</label>
          <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" placeholder="Repeat Password" aria-label="Repeat Password" autocomplete="off">
        </div>

        <button type="button" onclick="user.add_user();" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customerView" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name" />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input type="email" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx" />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">DOB</label>
            <input type="date" id="dobWithTitle" class="form-control" placeholder="DD / MM / YY" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>