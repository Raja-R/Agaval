<div class="container-xxl flex-grow-1 container-p-y">

  <div class="row g-4">

    <div class="col-12">
      <div class="card">
        <div class="card-datatable table-responsive">
          <table class="datatables-taxes table border-top">
            <thead>
              <tr>
                <th></th>
                <th>Tax Name</th>
                <th>Percentage</th>
                <th>Register Number</th>
                <th>Default Tax</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addTaxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-tax">
      <div class="modal-content p-3 p-md-2">
        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <div class="text-center mb-4">
            <h3 class="tax-title mb-2">Add New Tax</h3>
          </div>
          <form id="addTaxForm" class="row g-3" action="<?php echo site_url(); ?>Site/add_tax" method="POST">
            <input type="hidden" id="hdn_tax_id" name="hdn_tax_id" class="form-control" />

            <div class="col-12 mb-2">
              <label class="form-label" for="tax_name">Tax Name</label>
              <input type="text" id="tax_name" name="tax_name" class="form-control" placeholder="Enter a Tax name" tabindex="-1" />
            </div>
            <div class="col-12 mb-2">
              <label class="form-label" for="tax_percentage">Percentage</label>
              <input type="text" id="tax_percentage" name="tax_percentage" class="form-control" placeholder="Enter a tax Percentage" tabindex="-1" />
            </div>
            <div class="col-12 mb-2">
              <label class="form-label" for="tax_reg_no">Register Number</label>
              <input type="text" id="tax_reg_no" name="tax_reg_no" class="form-control" placeholder="Enter a tax Register Number" tabindex="-1" />
            </div>

            <div class="col-12 mb-md-0 mb-2">
              <div class="form-check custom-option custom-option-basic checked">
                <label class="form-check-label custom-option-content" for="default_tax">
                  <input class="form-check-input" type="checkbox" value="YES" name="default_tax" id="default_tax">
                  <span class="custom-option-header">
                    <span class="h6 mb-0">Default Tax</span>
                  </span>
                  <span class="custom-option-body">
                    <small class="option-text">The default tax will be automatically selected on the product screen if it is checked.</small>
                  </span>
                </label>
              </div>
            </div>

            <div class="col-12 mb-md-0 mb-2">
              <label class="form-label" for="tax_status">Tax Status </label>

              <label class="switch switch-outline">
                <input type="checkbox" class="switch-input" id="tax_status" name="tax_status" value="ACTIVE" checked>
                <span class="switch-toggle-slider">
                  <span class="switch-on">
                    <i class="ti ti-check"></i>
                  </span>
                  <span class="switch-off">
                    <i class="ti ti-x"></i>
                  </span>
                </span>
                <span class="switch-label"></span>
              </label>

            </div>

            <div class="col-12 text-center mt-4">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade dtr-bs-modal" id="viewTaxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-view-tax">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Tax</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body tax_view_content">

        </div>
      </div>
    </div>
  </div>

</div>