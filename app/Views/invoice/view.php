<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Invoice View -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0">Invoice Details</h5>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          <i class="ti ti-dots-vertical me-1"></i>Actions
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#" onclick="window.print()"><i class="ti ti-printer me-1"></i>Print</a></li>
          <li><a class="dropdown-item" href="<?php echo site_url('Invoice/export_pdf/' . $invoice_data['id']); ?>"><i class="ti ti-file-text me-1"></i>Export PDF</a></li>
          <li><a class="dropdown-item" href="<?php echo site_url('Invoice/update/' . $invoice_data['id']); ?>"><i class="ti ti-edit me-1"></i>Edit</a></li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <?php if(isset($invoice_data)): ?>

        <!-- Invoice Header -->
        <div class="row mb-4">
          <div class="col-md-6">
            <h6>Invoice Information</h6>
            <p><strong>Invoice Number:</strong> <?php echo $invoice_data['order_no']; ?></p>
            <p><strong>Date:</strong> <?php echo date('d/m/Y', strtotime($invoice_data['date'])); ?></p>
            <p><strong>Status:</strong>
              <span class="badge bg-<?php
                switch($invoice_data['status']) {
                  case 'DRAFT': echo 'secondary'; break;
                  case 'ORDERED': echo 'primary'; break;
                  case 'SCHEDULED': echo 'warning'; break;
                  case 'CANCELED': echo 'danger'; break;
                  case 'DELIVERED': echo 'success'; break;
                  default: echo 'secondary';
                }
              ?>"><?php echo $invoice_data['status']; ?></span>
            </p>
          </div>
          <div class="col-md-6">
            <h6>Customer Information</h6>
            <p><strong>Name:</strong> <?php echo $invoice_data['customer']['name']; ?></p>
            <?php if(isset($invoice_data['customer']['mobile'])): ?>
              <p><strong>Mobile:</strong> <?php echo $invoice_data['customer']['mobile']; ?></p>
            <?php endif; ?>
            <p><strong>User ID:</strong> <?php echo $invoice_data['user_id']; ?></p>
          </div>
        </div>

        <!-- Products Table -->
        <div class="row mb-4">
          <div class="col-12">
            <h6>Products</h6>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total_amount = 0;
                  if(isset($invoice_data['products']) && !empty($invoice_data['products'])):
                    $sn = 1;
                    foreach($invoice_data['products'] as $product):
                      $amount = $product['quantity'] * $product['rate'];
                      $total_amount += $amount;
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo isset($product['name']) ? $product['name'] : $product['product_name']; ?></td>
                      <td><?php echo $product['quantity']; ?></td>
                      <td>₹<?php echo number_format($product['rate'], 2); ?></td>
                      <td>₹<?php echo number_format($amount, 2); ?></td>
                    </tr>
                  <?php
                    endforeach;
                  else:
                  ?>
                    <tr>
                      <td colspan="5" class="text-center">No products found</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4" class="text-end">Subtotal:</th>
                    <th>₹<?php echo number_format($total_amount, 2); ?></th>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-end">Discount:</th>
                    <th>₹<?php echo number_format($invoice_data['discount'] ?? 0, 2); ?></th>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-end">Tax:</th>
                    <th>₹<?php echo number_format($invoice_data['tax'] ?? 0, 2); ?></th>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-end">Total:</th>
                    <th>₹<?php echo number_format($invoice_data['total'] ?? $total_amount, 2); ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <!-- Description -->
        <?php if(isset($invoice_data['description']) && !empty($invoice_data['description'])): ?>
        <div class="row mb-4">
          <div class="col-12">
            <h6>Description/Notes</h6>
            <p><?php echo nl2br($invoice_data['description']); ?></p>
          </div>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="row">
          <div class="col-12 text-end">
            <a href="<?php echo site_url('Invoice'); ?>" class="btn btn-label-secondary">
              <i class="ti ti-arrow-left me-1"></i>Back to List
            </a>
            <a href="<?php echo site_url('Invoice/update/' . $invoice_data['id']); ?>" class="btn btn-primary">
              <i class="ti ti-edit me-1"></i>Edit Invoice
            </a>
          </div>
        </div>

      <?php else: ?>
        <div class="text-center">
          <p class="text-muted">Invoice not found or invalid invoice ID.</p>
          <a href="<?php echo site_url('Invoice'); ?>" class="btn btn-primary">Back to List</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
