<?php include('common/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include('common/sidebar.php'); ?>

      <!-- Layout container -->
      <div class="layout-page">
        <?php include('common/navbar.php'); ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-semibold mb-4">Roles List</h4>

            <p class="mb-4">
              A role provided access to predefined menus and features so that depending on 
              assigned role an administrator can have access to what user needs.
            </p>
            <!-- Role cards -->
            <div class="row g-4">
              <?php foreach($role_list as $key=>$value){ ?>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 4 users</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1"><?php echo $value->description; ?></h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                  <div class="row h-100">
                    <div class="col-sm-5">
                      <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="<?php echo base_url(); ?>/public/assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83" />
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="card-body text-sm-end text-center ps-sm-0">
                        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-2 text-nowrap add-new-role">
                          Add New Role
                        </button>
                        <p class="mb-0 mt-1">Add role, if it does not exist</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <!-- Role Table -->
                <div class="card">
                  <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                      <thead>
                        <tr>
                          <th></th>
                          <th>User</th>
                          <th>Role</th>
                          <th>Plan</th>
                          <th>Billing</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <!--/ Role Table -->
              </div>
            </div>
            <!--/ Role cards -->

            <!-- Add Role Modal -->
            <!-- Add Role Modal -->
            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                  <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                  <div class="modal-body">
                    <div class="text-center mb-4">
                      <h3 class="role-title mb-2">Add New Role</h3>
                      <p class="text-muted">Set role permissions</p>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" class="row g-3" action="<?php echo site_url(); ?>add_role" method="POST">
                      <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                      </div>
                      <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Description</label>
                        <input type="text" id="role_desc" name="role_desc" class="form-control" placeholder="Enter a role description" tabindex="-1" />
                      </div>
                      <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                          Cancel
                        </button>
                      </div>
                    </form>
                    <!--/ Add role form -->
                  </div>
                </div>
              </div>
            </div>
            <!--/ Add Role Modal -->

            <!-- / Add Role Modal -->
          </div>
          <!-- / Content -->

          <?php include('common/footer.php'); ?>

          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/jszip/jszip.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/pdfmake/pdfmake.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/cleavejs/cleave.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
          <script src="<?php echo base_url(); ?>/public/assets/js/app-user-list.js"></script>