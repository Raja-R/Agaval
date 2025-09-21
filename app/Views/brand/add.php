<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="user_form" action="<?php echo site_url(); ?>Brand/add" method="POST" enctype="multipart/form-data" autocomplete="off">

                        <input type="hidden" id="hdn_brand_id" name="hdn_brand_id" class="form-control" value="<?php if (isset($brand_data[0])) {
                                                                                                                                                    echo $brand_data[0]['id'];
                                                                                                                                                } ?>">
                        <div class="row g-3">




                            <div class="col-md-12">
                                <label class="form-label" for="brand_name">Name</label>
                                <input type="text" id="brand_name" name="brand_name" class="form-control phone-mask" placeholder="Name" aria-label="Amount" value="<?php if (isset($brand_data[0])) {
                                                                                                                                                                                    echo $brand_data[0]['name'];
                                                                                                                                                                                } ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="brand_desc">Description</label>
                                <input type="text" id="brand_desc" name="brand_desc" class="form-control" placeholder="Description" value="<?php if (isset($brand_data[0])) {
                                                                                                                                                            echo $brand_data[0]['description'];
                                                                                                                                                        } ?>">
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="form-label" for="brand_status">Status</label>
                                </div>
                                <label class="switch switch-square">
                                    <input type="checkbox" class="switch-input" name="brand_status" id="brand_status" value="ACTIVE" <?php if (isset($brand_data[0]) && $brand_data[0]['status'] == 'INACTIVE') {
                                                                                                                                            } else {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="ti ti-check"></i></span>
                                        <span class="switch-off"><i class="ti ti-x"></i></span>
                                    </span>
                                    <span class="switch-label"></span>
                                </label>
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