<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="user_form" action="<?php echo site_url(); ?>user_register" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <h6>Account Details</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="multicol-">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="user_email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="user_email" name="user_email" class="form-control" placeholder="name" aria-label="name" aria-describedby="user_email">
                                    <span class="input-group-text" id="user_email">@example.com</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="user_password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="user_password" name="user_password" class="form-control" placeholder="" aria-describedby="user_password">
                                        <span class="input-group-text cursor-pointer" id="user_password"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="pass_confirm">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" placeholder="" aria-describedby="pass_confirm">
                                        <span class="input-group-text cursor-pointer" id="pass_confirm"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 mx-n4">
                        <h6>Personal Info</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="multicol-first-name">First Name</label>
                                <input type="text" id="user_first_name" name="user_first_name" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="user_last_name">Last Name</label>
                                <input type="text" id="user_last_name" name="user_last_name" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="user_role">Role</label>
                                <select id="user_role" name="user_role" class="form-select" tabindex="-1" aria-hidden="true">
                                    <option value="">--Select--</option>
                                    <?php foreach($role_list as $key=>$value){ ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->description; ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="user_birth_date">Birth Date</label>
                                <input type="text" id="user_birth_date" name="user_birth_date" class="form-control dob-picker flatpickr-input" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="user_mobile">Mobile Number</label>
                                <input type="text" id="user_mobile" name="user_mobile" class="form-control phone-mask" placeholder="9876543210" aria-label="9876543210">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Address</label>
                                <input type="text" id="user_address" name="user_address" class="form-control phone-mask" placeholder="Address" aria-label="">
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                            <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>