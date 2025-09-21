<div class="container-xxl flex-grow-1 container-p-y">

  <div class="row">
    <div class="col">
      <div class="card mb-3">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">
                Site Details
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab" aria-selected="false">
                Prefix Details
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-social" role="tab" aria-selected="false">
                Site Sign
              </button>
            </li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_setting" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Site Name" aria-describedby="site_nameHelp" value="<?php echo $config_detail->site_name ?>" />
                    <label for="site_name">Site Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="support_number" name="support_number" placeholder="Support Number" aria-describedby="support_numberHelp" value="<?php echo $config_detail->support_no ?>" />
                    <label for="support_number">Support Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="support_email" name="support_email" placeholder="Support Email" aria-describedby="support_emailHelp" value="<?php echo $config_detail->support_email ?>" />
                    <label for="support_email">Support Email</label>
                  </div>
                </div>
                <div class="col-md-6 select2-primary">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="site_copyright" name="site_copyright" placeholder="Copyright Details" aria-describedby="site_copyrightHelp" value="<?php echo $config_detail->copy_right ?>" />
                    <label for="site_copyright">Copyright Details</label>
                  </div>
                </div>
              </div>

              <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_setting" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_category" name="prefix_category" placeholder="Category" aria-describedby="prefix_categoryHelp" value="<?php echo $config_detail->prefix_category ?>" />
                    <label for="prefix_category">Category</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_product" name="prefix_product" placeholder="Product" aria-describedby="prefix_productHelp" value="<?php echo $config_detail->prefix_product ?>" />
                    <label for="prefix_product">Product</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_supplier" name="prefix_supplier" placeholder="Supplier" aria-describedby="prefix_supplierHelp" value="<?php echo $config_detail->prefix_supplier ?>" />
                    <label for="prefix_supplier">Supplier</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_brand" name="prefix_brand" placeholder="Sales" aria-describedby="prefix_brandHelp" value="<?php echo $config_detail->prefix_brand ?>" />
                    <label for="prefix_brand">Brand</label>
                  </div>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_sales" name="prefix_sales" placeholder="Sales" aria-describedby="prefix_salesHelp" value="<?php echo $config_detail->prefix_sale ?>" />
                    <label for="prefix_sales">Sales</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_purchase" name="prefix_purchase" placeholder="Purchase" aria-describedby="prefix_purchaseHelp" value="<?php echo $config_detail->prefix_purchase ?>" />
                    <label for="prefix_purchase">Purchase</label>
                  </div>
                </div>

              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_invoice" name="prefix_invoice" placeholder="Invoice" aria-describedby="prefix_invoiceHelp" value="<?php echo $config_detail->prefix_invoice ?>" />
                    <label for="prefix_invoice">Invoice</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prefix_expense" name="prefix_expense" placeholder="Expense" aria-describedby="prefix_expenseHelp" value="<?php echo $config_detail->prefix_expense ?>" />
                    <label for="prefix_expense">Expense</label>
                  </div>
                </div>

              </div>

              <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
            <form name="setting_form" action="<?php echo site_url(); ?>Site/update_setting" method="POST" enctype="multipart/form-data">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="site_logo" class="form-label">Logo</label>
                    <input class="form-control" type="file" id="site_logo" name="site_logo">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="site_favicon" class="form-label">Favicon</label>
                    <input class="form-control" type="file" id="site_favicon" name="site_favicon">
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