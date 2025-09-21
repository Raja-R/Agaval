<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="user_form" action="<?php echo site_url(); ?>Expenses/add" method="POST" enctype="multipart/form-data" autocomplete="off">

                        <input type="hidden" id="hdn_expense_id" name="hdn_expense_id" class="form-control" placeholder="Customer Name" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                    echo $expense_data[0]['id'];
                                                                                                                                                } ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="expenses_date">Expense Date</label>
                                <input type="text" id="expenses_date" name="expenses_date" class="form-control dob-picker flatpickr-input" placeholder="DD-MM-YYYY" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                                                echo $expense_data[0]['expense_date'];
                                                                                                                                                                            }else{ echo date('d-m-Y'); } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="expenses_category">Category </label>
                                <select id="expenses_category" name="expenses_category" class="form-select" tabindex="-1" aria-hidden="true">
                                    <option value="">--Select--</option>
                                    <?php 
                                    foreach ($category_data as $key => $value) { 
                                        $selected = '';
                                        if (isset($expense_data[0]) && $expense_data[0]['category_id']==$value->id) {
                                            $selected = 'selected';
                                        }
                                    ?>
                                        <option <?php echo $selected; ?> value="<?php echo $value->id; ?>"><?php echo $value->category_name; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="expenses_for">Expense for</label>
                                <input type="text" id="expenses_for" name="expenses_for" class="form-control" placeholder="" aria-label="" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                        echo $expense_data[0]['expense_for'];
                                                                                                                                                    } ?>">
                            </div>



                            <div class="col-md-6">
                                <label class="form-label" for="expenses_amount">Amount</label>
                                <input type="text" id="expenses_amount" name="expenses_amount" class="form-control phone-mask" placeholder="Amount" aria-label="Amount" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                                                    echo $expense_data[0]['expense_amt'];
                                                                                                                                                                                } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="expenses_ref_no">Reference No</label>
                                <input type="text" id="expenses_ref_no" name="expenses_ref_no" class="form-control" placeholder="Reference No" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                            echo $expense_data[0]['reference_no'];
                                                                                                                                                        } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="expenses_note">Note</label>
                                <input type="text" id="expenses_note" name="expenses_note" class="form-control" placeholder="Note" value="<?php if (isset($expense_data[0])) {
                                                                                                                                                echo $expense_data[0]['note'];
                                                                                                                                            } ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label" for="expenses_status">Status</label>
                                </div>
                                <label class="switch switch-square">
                                    <input type="checkbox" class="switch-input" name="expenses_status" id="expenses_status" value="ACTIVE" <?php if (isset($expense_data[0]) && $expense_data[0]['status'] == 'INACTIVE') {
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