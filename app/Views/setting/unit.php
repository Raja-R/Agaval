<div class="container-xxl flex-grow-1 container-p-y">

  <div class="row g-4">

    <div class="col-12">
      <div class="card">
        <div class="card-datatable table-responsive">
          <table class="datatables-units table border-top">
            <thead>
              <tr>
                <th></th>
                <th>Unit Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addUnitModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-unit">
      <div class="modal-content p-3 p-md-2">
        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
          <div class="text-center mb-4">
            <h3 class="unit-title mb-2">Add New Unit</h3>
          </div>
          <form id="addUnitForm" class="row g-3" action="<?php echo site_url(); ?>Site/add_unit" method="POST">
            <input type="hidden" id="hdn_unit_id" name="hdn_unit_id" class="form-control" />

            <div class="col-12 mb-2">
              <label class="form-label" for="unit_name">Unit Name</label>
              <input type="text" id="unit_name" name="unit_name" class="form-control" placeholder="Enter a Unit name" tabindex="-1" />
            </div>
            <div class="col-12 mb-2">
              <label class="form-label" for="unit_description">Description</label>
              <input type="text" id="unit_description" name="unit_description" class="form-control" placeholder="Enter a Unit Description" tabindex="-1" />
            </div>
            

            <div class="col-12 mb-md-0 mb-2">
              <label class="form-label" for="unit_status">Unit Status </label>

              <label class="switch switch-outline">
                <input type="checkbox" class="switch-input" id="unit_status" name="unit_status" value="ACTIVE" checked>
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

  <div class="modal fade dtr-bs-modal" id="viewUnitModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-view-unit">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Unit</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body unit_view_content">

        </div>
      </div>
    </div>
  </div>

</div>