<div class="container-xxl flex-grow-1 container-p-y">
  
  <!-- Users List Table -->
  <div class="card">
    
    <div class="card-datatable table-responsive">
      <table class="datatables-expense-cat table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Created On</th>
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


