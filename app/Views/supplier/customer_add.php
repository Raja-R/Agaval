<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="user_form" action="<?php echo site_url(); ?>Suppliers/add" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <h6>Personal Info</h6>
                        <input type="hidden" id="hdn_customerid" name="hdn_customerid" class="form-control" placeholder="Customer Name" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->id; } ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="customer_name">Name</label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Customer Name" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->name; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_mobile">Mobile Number</label>
                                <input type="text" id="customer_mobile" name="customer_mobile" class="form-control phone-mask" placeholder="9876543210" aria-label="9876543210" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->mobile; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_email">Email Address</label>
                                <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="" aria-label="" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->email; } ?>">
                            </div>



                            <div class="col-md-6">
                                <label class="form-label" for="customer_mobile">Phone Number</label>
                                <input type="text" id="customer_phone" name="customer_phone" class="form-control phone-mask" placeholder="0444563210" aria-label="0444563210" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->phone; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_gst">GST Number</label>
                                <input type="text" id="customer_gst" name="customer_gst" class="form-control" placeholder="GST Number" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->gst_no; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_tax">Tax Number</label>
                                <input type="text" id="customer_tax" name="customer_tax" class="form-control" placeholder="Tax Number" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->tax_no; } ?>">
                            </div>

                        </div>
                        <hr class="my-4 mx-n4">
                        <h6>Address Details</h6>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="customer_address">Address</label>
                                <textarea class="form-control" id="customer_address" name="customer_address" rows="2"><?php if(isset($customer_data[0])){ echo $customer_data[0]->address; } ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_city">City</label>
                                <input type="text" id="customer_city" name="customer_city" class="form-control" placeholder="City" aria-label="" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->city; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_state">State</label>
                                <select id="customer_state" name="customer_state" class="form-select" tabindex="-1" aria-hidden="true">
                                    <option value="TN">Tamilnadu</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_country">Country</label>
                                <select id="customer_country" name="customer_country" class="form-select" tabindex="-1" aria-hidden="true">
                                    <option value="IN">India</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_postcode">Post Code</label>
                                <input type="number" id="customer_postcode" name="customer_postcode" class="form-control" placeholder="Post Code" aria-label="" value="<?php if(isset($customer_data[0])){ echo $customer_data[0]->postcode; } ?>">
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