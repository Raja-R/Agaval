<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="user_form" action="<?php echo site_url(); ?>Expenses/save_category" method="POST" enctype="multipart/form-data" autocomplete="off">

                        <input type="hidden" id="hdn_categoryid" name="hdn_categoryid" class="form-control" placeholder="" value="<?php if (isset($category_data[0])) {
                                                                                                                                                    echo $category_data[0]->id;
                                                                                                                                                } ?>">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="category_name">Category Name</label>
                                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" value="<?php if (isset($category_data[0])) {
                                                                                                                                                        echo $category_data[0]->category_name;
                                                                                                                                                    } ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="category_desc">Description</label>
                                <textarea type="text" id="category_desc" name="category_desc" class="form-control" placeholder="Description" aria-label="Description"><?php if (isset($category_data[0])) {
                                                                                                                                                                            echo $category_data[0]->description;
                                                                                                                                                                        } ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="form-label" for="category_status">Status</label>
                                </div>
                                <label class="switch switch-square">
                                    <input type="checkbox" class="switch-input" name="category_status" id="category_status" value="ACTIVE" <?php if (isset($category_data[0]) && $category_data[0]=='INACTIVE') {
                                                                                                                                                                           
                                                                                                                                                                        }else{ echo 'checked'; } ?>>
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