<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Invoice Add Form -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0"><?php echo isset($invoice_data) ? 'Edit Invoice' : 'Create New Invoice'; ?></h5>
    </div>
    <div class="card-body">
      <form id="invoiceForm" method="post" action="<?php echo site_url('Invoice/save'); ?>">

        <!-- Invoice Header -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="invoice_date">Invoice Date</label>
            <input type="date" class="form-control" id="invoice_date" name="date"
                   value="<?php echo isset($invoice_data['date']) ? date('Y-m-d', strtotime($invoice_data['date'])) : date('Y-m-d'); ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="order_no">Invoice Number</label>
            <input type="text" class="form-control" id="order_no" name="order_no"
                   value="<?php echo isset($invoice_data['order_no']) ? $invoice_data['order_no'] : ''; ?>" readonly>
          </div>
        </div>

        <!-- Customer Selection -->
        <div class="row mb-4">
          <div class="col-md-12">
            <label class="form-label" for="user_id">Customer</label>
            <select class="form-select" id="user_id" name="user_id" required>
              <option value="">Select Customer</option>
              <?php if(isset($customer_list)) foreach($customer_list as $customer): ?>
                <option value="<?php echo $customer['id']; ?>"
                        data-gstin="<?php echo $customer['gst_no'] ?? ''; ?>"
                        data-name="<?php echo $customer['name'] ?? ''; ?>"
                        data-address="<?php echo $customer['address'] ?? ''; ?>"
                        data-state="<?php echo $customer['state'] ?? ''; ?>"
                        data-code="<?php echo $customer['code'] ?? ''; ?>"
                        <?php echo (isset($invoice_data['user_id']) && $invoice_data['user_id'] == $customer['id']) ? 'selected' : ''; ?>>
                  <?php echo $customer['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <!-- Invoice Details -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="reference">Reference No</label>
            <input type="text" class="form-control" id="reference" name="reference"
                   value="<?php echo isset($invoice_data['reference']) ? $invoice_data['reference'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="reference_date">Reference Date</label>
            <input type="date" class="form-control" id="reference_date" name="reference_date"
                   value="<?php echo isset($invoice_data['reference_date']) ? date('Y-m-d', strtotime($invoice_data['reference_date'])) : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="other_reference">Other Reference</label>
            <input type="text" class="form-control" id="other_reference" name="other_reference"
                   value="<?php echo isset($invoice_data['other_reference']) ? $invoice_data['other_reference'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="delivery_note">Delivery Note</label>
            <input type="text" class="form-control" id="delivery_note" name="delivery_note"
                   value="<?php echo isset($invoice_data['delivery_note']) ? $invoice_data['delivery_note'] : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="delivery_note_date">Delivery Note Date</label>
            <input type="date" class="form-control" id="delivery_note_date" name="delivery_note_date"
                   value="<?php echo isset($invoice_data['delivery_note_date']) ? date('Y-m-d', strtotime($invoice_data['delivery_note_date'])) : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="terms_of_delivery">Terms of Delivery</label>
            <input type="text" class="form-control" id="terms_of_delivery" name="terms_of_delivery"
                   value="<?php echo isset($invoice_data['terms_of_delivery']) ? $invoice_data['terms_of_delivery'] : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="terms_of_payment">Terms of Payment</label>
            <input type="text" class="form-control" id="terms_of_payment" name="terms_of_payment"
                   value="<?php echo isset($invoice_data['terms_of_payment']) ? $invoice_data['terms_of_payment'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="buyer_order_no">Buyer Order No</label>
            <input type="text" class="form-control" id="buyer_order_no" name="buyer_order_no"
                   value="<?php echo isset($invoice_data['buyer_order_no']) ? $invoice_data['buyer_order_no'] : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="buyer_order_date">Buyer Order Date</label>
            <input type="date" class="form-control" id="buyer_order_date" name="buyer_order_date"
                   value="<?php echo isset($invoice_data['buyer_order_date']) ? date('Y-m-d', strtotime($invoice_data['buyer_order_date'])) : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="buyer_gstin">GSTIN</label>
            <input type="text" class="form-control" id="buyer_gstin" name="buyer_gstin"
                   value="<?php echo isset($invoice_data['buyer_gstin']) ? $invoice_data['buyer_gstin'] : ''; ?>">
          </div>
        </div>

        <!-- Seller Details -->
        <h6 class="mb-3">Seller Details</h6>
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="seller_gstin">GSTIN</label>
            <input type="text" class="form-control" id="seller_gstin" name="seller_gstin"
                   value="<?php echo isset($invoice_data['seller_gstin']) ? $invoice_data['seller_gstin'] : '33AAPFH8577A1Z7'; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="seller_state">State</label>
            <input type="text" class="form-control" id="seller_state" name="seller_state"
                   value="<?php echo isset($invoice_data['seller_state']) ? $invoice_data['seller_state'] : 'Tamil Nadu'; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="seller_code">State Code</label>
            <input type="text" class="form-control" id="seller_code" name="seller_code"
                   value="<?php echo isset($invoice_data['seller_code']) ? $invoice_data['seller_code'] : '33'; ?>">
          </div>
        </div>

        <!-- Buyer Details -->
        <h6 class="mb-3">Buyer Details</h6>
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="buyer_name">Name</label>
            <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                   value="<?php echo isset($invoice_data['buyer_name']) ? $invoice_data['buyer_name'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="buyer_state">State</label>
            <input type="text" class="form-control" id="buyer_state" name="buyer_state"
                   value="<?php echo isset($invoice_data['buyer_state']) ? $invoice_data['buyer_state'] : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="buyer_code">State Code</label>
            <input type="text" class="form-control" id="buyer_code" name="buyer_code"
                   value="<?php echo isset($invoice_data['buyer_code']) ? $invoice_data['buyer_code'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="buyer_address">Address</label>
            <textarea class="form-control" id="buyer_address" name="buyer_address" rows="2"><?php echo isset($invoice_data['buyer_address']) ? $invoice_data['buyer_address'] : ''; ?></textarea>
          </div>
        </div>

        <!-- Dispatch Details -->
        <h6 class="mb-3">Dispatch Details</h6>
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="dispatch_from">Dispatch From</label>
            <input type="text" class="form-control" id="dispatch_from" name="dispatch_from"
                   value="<?php echo isset($invoice_data['dispatch_from']) ? $invoice_data['dispatch_from'] : ''; ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="dispatch_to">Destination</label>
            <input type="text" class="form-control" id="dispatch_to" name="dispatch_to"
                   value="<?php echo isset($invoice_data['dispatch_to']) ? $invoice_data['dispatch_to'] : ''; ?>">
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="dispatch_doc_no">Dispatch Doc No</label>
            <input type="text" class="form-control" id="dispatch_doc_no" name="dispatch_doc_no"
                   value="<?php echo isset($invoice_data['dispatch_doc_no']) ? $invoice_data['dispatch_doc_no'] : ''; ?>">
          </div>
        </div>

        <!-- Invoice Details -->
        <div class="row mb-4">
          <div class="col-md-12">
            <label class="form-label" for="description">Description/Notes</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($invoice_data['description']) ? $invoice_data['description'] : ''; ?></textarea>
          </div>
        </div>

        <!-- Products Section -->
        <div class="row mb-4">
          <div class="col-md-12">
            <h6>Products</h6>
            <div id="products-container">
              <div class="product-row row mb-2">
                <div class="col-md-2">
                  <select class="form-select product-select" name="products[0][product_id]">
                    <option value="">Select Product</option>
                    <?php if(isset($product_list)) foreach($product_list as $product): ?>
                      <option value="<?php echo $product['id']; ?>" data-rate="<?php echo $product['sales_price']; ?>" data-tax="<?php echo $product['tax_id'] ?? 0; ?>" data-name="<?php echo $product['name']; ?>" data-hsn="<?php echo $product['hsn_code'] ?? ''; ?>">
                        <?php echo $product['name']; ?> (₹<?php echo number_format($product['sales_price'], 2); ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <input type="hidden" name="products[0][product_id]" class="product-id">
                </div>
                <div class="col-md-2">
                  <input type="text" class="form-control hsn-sac" name="products[0][hsn_sac]" placeholder="HSN/SAC" value="">
                </div>
                <div class="col-md-2">
                  <input type="number" class="form-control quantity" name="products[0][quantity]" placeholder="Qty" value="1" min="1">
                </div>
                <div class="col-md-2">
                  <input type="number" class="form-control rate" name="products[0][rate]" placeholder="Rate" step="0.01" readonly>
                </div>
                <div class="col-md-2">
                  <select class="form-select tax-select" name="products[0][tax_id]">
                    <option value="">Select Tax</option>
                    <?php if(isset($tax_list)) foreach($tax_list as $tax): ?>
                      <option value="<?php echo $tax->id; ?>" data-percentage="<?php echo $tax->percentage; ?>">
                        <?php echo $tax->name; ?> (<?php echo $tax->percentage; ?>%)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-1">
                  <input type="number" class="form-control amount" name="products[0][amount]" placeholder="Amount" readonly>
                </div>
                <div class="col-md-1">
                  <button type="button" class="btn btn-danger btn-sm remove-product">
                    <i class="ti ti-minus"></i>
                  </button>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm mt-2" id="add-product">
              <i class="ti ti-plus me-1"></i>Add Product
            </button>
          </div>
        </div>

        <!-- Calculations -->
        <div class="row mb-4">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-6">Subtotal:</div>
              <div class="col-6 text-end" id="subtotal">₹0.00</div>
            </div>
            <div class="row">
              <div class="col-12" id="tax-rate-display"></div>
            </div>
            <div class="row">
              <div class="col-6">Discount:</div>
              <div class="col-6 text-end">
                <input type="number" class="form-control form-control-sm d-inline-block w-75" id="discount" name="discount" value="0" step="0.01">
              </div>
            </div>
            <div class="row">
              <div class="col-6">Tax Amount:</div>
              <div class="col-6 text-end" id="tax">₹0.00</div>
            </div>
            <div class="row fw-bold">
              <div class="col-6">Total:</div>
              <div class="col-6 text-end" id="total">₹0.00</div>
            </div>
          </div>
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="hdn_invoiceid" value="<?php echo isset($invoice_data['id']) ? $invoice_data['id'] : ''; ?>">
        <input type="hidden" name="subtotal" id="subtotal-input" value="0">
        <input type="hidden" name="tax_amount" id="tax-input" value="0">
        <input type="hidden" name="total" id="total-input" value="0">

        <!-- Action Buttons -->
        <div class="row">
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary me-2">
              <i class="ti ti-device-floppy me-1"></i>Save Invoice
            </button>
            <a href="<?php echo site_url('Invoice'); ?>" class="btn btn-label-secondary">
              <i class="ti ti-x me-1"></i>Cancel
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// jQuery-dependent functions - execute only when jQuery is loaded
function initInvoicePage() {
  var productIndex = 1;

  // Generate invoice number
  generateInvoiceNumber();

  // Add product row
  $(document).on('click', '#add-product', function(e) {
    e.preventDefault();
    addProductRow();
    console.log('Added new product row');
  });

  // Remove product row
  $(document).on('click', '.remove-product', function(e) {
    e.preventDefault();
    $(this).closest('.product-row').remove();
    calculateTotal();
    console.log('Removed product row');
  });

  // Customer selection change
  $(document).on('change', '#user_id', function() {
    var selectedOption = $(this).find('option:selected');
    var gstin = selectedOption.data('gstin') || '';
    var name = selectedOption.data('name') || '';
    var address = selectedOption.data('address') || '';
    var state = selectedOption.data('state') || '';
    var code = selectedOption.data('code') || '';

    $('#buyer_gstin').val(gstin);
    $('#buyer_name').val(name);
    $('#buyer_address').val(address);
    $('#buyer_state').val(state);
    $('#buyer_code').val(code);
  });

  // Product selection change
  $(document).on('change', '.product-select', function() {
    console.log('Product selection changed');
    var row = $(this).closest('.product-row');
    var selectedOption = $(this).find('option:selected');
    var rate = parseFloat(selectedOption.data('rate')) || 0;
    var taxId = parseInt(selectedOption.data('tax')) || 0;
    var productId = $(this).val();
    var productName = selectedOption.data('name') || '';
    var hsnCode = selectedOption.data('hsn') || '';

    console.log('Selected product:', productName, 'Rate:', rate, 'Tax ID:', taxId, 'HSN:', hsnCode);

    // Update hidden input with product ID
    row.find('.product-id').val(productId);
    row.find('.rate').val(rate.toFixed(2));
    row.find('.hsn-sac').val(hsnCode);

    // Auto-select tax if product has default tax
    if (taxId > 0) {
      row.find('.tax-select').val(taxId);
    }

    // Trigger calculation
    calculateRowTotal(row);
  });

  // Tax selection change
  $(document).on('change', '.tax-select', function() {
    console.log('Tax selection changed');
    var row = $(this).closest('.product-row');
    calculateRowTotal(row);
  });

  // Quantity or rate change
  $(document).on('input', '.quantity, .rate', function() {
    var row = $(this).closest('.product-row');
    calculateRowTotal(row);
  });

  // Discount change
  $('#discount').on('input', function() {
    calculateTotal();
    console.log('Discount changed, recalculating total');
  });

  function addProductRow() {
    var templateRow = $('.product-row').first();
    var newRow = templateRow.clone();

    newRow.find('.product-select').attr('name', 'products[' + productIndex + '][product_id]').val('');
    newRow.find('.product-id').attr('name', 'products[' + productIndex + '][product_id]').val('');
    newRow.find('.hsn-sac').attr('name', 'products[' + productIndex + '][hsn_sac]').val('');
    newRow.find('.quantity').attr('name', 'products[' + productIndex + '][quantity]').val(1);
    newRow.find('.rate').attr('name', 'products[' + productIndex + '][rate]').val('');
    newRow.find('.tax-select').attr('name', 'products[' + productIndex + '][tax_id]').val('');
    newRow.find('.amount').attr('name', 'products[' + productIndex + '][amount]').val('');
    newRow.find('option:selected').prop('selected', false);

    $('#products-container').append(newRow);
    productIndex++;
    console.log('New product row added, current index:', productIndex);
  }

  function calculateRowTotal(row) {
    var quantity = parseFloat(row.find('.quantity').val()) || 0;
    var rate = parseFloat(row.find('.rate').val()) || 0;
    var amount = quantity * rate;

    console.log('Calculating row total: qty=', quantity, 'rate=', rate, 'amount=', amount);

    row.find('.amount').val(amount.toFixed(2));

    // Update form inputs
    row.find('input[name*="[quantity]"]').val(quantity);
    row.find('input[name*="[rate]"]').val(rate.toFixed(2));
    row.find('input[name*="[amount]"]').val(amount.toFixed(2));

    calculateTotal();
  }

  function calculateTotal() {
    var subtotal = 0;
    var totalTaxAmount = 0;
    var taxBreakdown = {};

    $('.product-row').each(function() {
      var row = $(this);
      var amount = parseFloat(row.find('.amount').val()) || 0;
      var taxSelect = row.find('.tax-select');
      var selectedTaxOption = taxSelect.find('option:selected');
      var taxPercentage = parseFloat(selectedTaxOption.data('percentage')) || 0;
      var taxName = selectedTaxOption.text() || 'No Tax';

      subtotal += amount;

      if (taxPercentage > 0) {
        var taxAmount = amount * (taxPercentage / 100);
        totalTaxAmount += taxAmount;

        if (!taxBreakdown[taxName]) {
          taxBreakdown[taxName] = { percentage: taxPercentage, amount: 0 };
        }
        taxBreakdown[taxName].amount += taxAmount;
      }

      console.log('Row calculation: amount=', amount, 'tax%=', taxPercentage, 'tax amount=', taxAmount);
    });

    var discount = parseFloat($('#discount').val()) || 0;
    var taxableAmount = subtotal - discount;
    var tax = totalTaxAmount;
    var total = taxableAmount + tax;

    console.log('Total calculation: subtotal=', subtotal, 'discount=', discount, 'tax=', tax, 'total=', total);

    $('#subtotal').text('₹' + subtotal.toFixed(2));

    // Display tax breakdown under subtotal
    var taxDisplay = '';
    if (Object.keys(taxBreakdown).length > 0) {
      taxDisplay = '<small class="text-muted">';
      for (var taxName in taxBreakdown) {
        if (taxBreakdown[taxName].amount > 0) {
          taxDisplay += taxName + ' (' + taxBreakdown[taxName].percentage + '%): ₹' + taxBreakdown[taxName].amount.toFixed(2) + '<br>';
        }
      }
      taxDisplay += '</small>';
    }
    $('#tax-rate-display').html(taxDisplay);

    $('#tax').text('₹' + tax.toFixed(2));
    $('#total').text('₹' + total.toFixed(2));

    $('#subtotal-input').val(subtotal.toFixed(2));
    $('#tax-input').val(tax.toFixed(2));
    $('#total-input').val(total.toFixed(2));
  }

  function generateInvoiceNumber() {
    $.ajax({
      url: '<?php echo site_url('Invoice/generate_number'); ?>',
      type: 'GET',
      success: function(response) {
        if (response && response.invoice_no) {
          $('#order_no').val(response.invoice_no);
          console.log('Generated invoice number:', response.invoice_no);
        } else {
          console.error('Invalid response format for invoice number:', response);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error generating invoice number:', status, error);
      }
    });
  }

  // Initialize calculation for existing rows
  $('.product-row').each(function() {
    var row = $(this);
    var selectedOption = row.find('.product-select option:selected');
    if (selectedOption.length && selectedOption.val() && selectedOption.val() !== '') {
      console.log('Initializing existing product row');
      var rate = parseFloat(selectedOption.data('rate')) || 0;
      var hsnCode = selectedOption.data('hsn') || '';

      if (rate > 0) {
        row.find('.rate').val(rate.toFixed(2));
        calculateRowTotal(row);
      }

      // Set HSN/SAC if available
      if (hsnCode) {
        row.find('.hsn-sac').val(hsnCode);
      }
    }
  });

  console.log('Invoice page initialized');
}

// Make sure jQuery is loaded before running our code
if (typeof jQuery !== 'undefined') {
  $(document).ready(function() {
    initInvoicePage();
  });
} else {
  // If jQuery is not ready, wait for it
  document.addEventListener('DOMContentLoaded', function() {
    // Check every 100ms if jQuery is loaded
    var checkJQuery = setInterval(function() {
      if (typeof jQuery !== 'undefined' && typeof $ !== 'undefined') {
        clearInterval(checkJQuery);
        initInvoicePage();
      }
    }, 100);
  });
}
</script>