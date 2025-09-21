<div class="container-xxl flex-grow-1 container-p-y">
  
  <div class="row">
    <div class="col">
      <div class="card mb-3">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">
                Profile Details
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab" aria-selected="false">
                Account Details
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-social" role="tab" aria-selected="false">
                Address Details
              </button>
            </li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_profile" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Application Name" aria-describedby="app_nameHelp" fdprocessedid="i3s8fo" value="<?php echo service('settings')->get('App.companyName');
 ?>">
                    <label for="app_name">Application Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_mobile" name="app_mobile" placeholder="Mobile Number" aria-describedby="app_mobileHelp" fdprocessedid="8qui4i" value="<?php echo service('settings')->get('App.companyMobile');
 ?>">
                    <label for="app_mobile">Mobile Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_phone" name="app_phone" placeholder="Phone Number" aria-describedby="app_phoneHelp" fdprocessedid="czewf" value="<?php echo service('settings')->get('App.companyPhone');
 ?>">
                    <label for="app_phone">Phone Number</label>
                  </div>
                </div>
                <div class="col-md-6 select2-primary">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="app_email" name="app_email" placeholder="Email Address" aria-describedby="app_emailHelp" fdprocessedid="j195wf" value="<?php echo service('settings')->get('App.companyEmail');
 ?>">
                    <label for="app_email">Email Address</label>
                  </div>
                </div>
              </div>

              <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_profile" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <textarea class="form-control" id="app_bank" name="app_bank" rows="3"><?php echo service('settings')->get('App.companyBank');
 ?></textarea>
                    <label for="app_bank">Bank Details</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_gst_no" name="app_gst_no" placeholder="GST Number" aria-describedby="app_gst_noHelp" fdprocessedid="ijfkoa" value="<?php echo service('settings')->get('App.companyGST');
 ?>">
                    <label for="app_gst_no">GST Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_pan_no" name="app_pan_no" placeholder="PAN Number" aria-describedby="app_pan_noHelp" fdprocessedid="anxmnr" value="<?php echo service('settings')->get('App.companyPAN');
 ?>">
                    <label for="app_pan_no">PAN Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_upi_id" name="app_upi_id" placeholder="UPI ID" aria-describedby="app_upi_idHelp" fdprocessedid="ykuu6i" value="<?php echo service('settings')->get('App.companyUPI');
 ?>">
                    <label for="app_upi_id">UPI ID</label>
                  </div>
                </div>
              </div>
              <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_profile" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <textarea class="form-control" id="app_address" name="app_address" rows="4"><?php echo service('settings')->get('App.companyAddress');
 ?></textarea>
                    <label for="app_address">Address</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="app_gst_no" name="app_post_code" placeholder="Postcode" aria-describedby="app_post_codeHelp" fdprocessedid="vo7dfo" value="<?php echo service('settings')->get('App.companyPostcode');
 ?>">
                    <label for="app_post_code">Postcode</label>
                  </div>
                </div>

              </div>
              <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>