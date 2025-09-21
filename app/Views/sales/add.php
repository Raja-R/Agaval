<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Add Sale Form -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0"><?php echo isset($sale_data) ? 'Edit Sale' : 'Create New Sale'; ?></h5>
    </div>
    <div class="card-body">
      <form id="saleForm" method="post" action="<?php echo site_url('Sales/save'); ?>">

        <!-- Sale Header -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" for="date">Sale Date</label>
            <input type="date" class="form-control" id="date" name="date"
                   value="<?php echo isset($sale_data['date']) ? date('Y-m-d', strtotime($sale_data['date'])) : date('Y-m-d'); ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="order_no">Sale Number</label>
            <input type="text" class="form-control" id="order_no" name="order_no"
                   value="<?php echo isset($sale_data['order_no']) ? $sale_data['order_no'] : ''; ?>" readonly>
          </div>
        </div>

        <!-- Customer Selection -->
        <div class="row mb-4">
          <div class="col-md-12">
            <label class="form-label" for="user_id">Customer <span class="text-danger">*</span></label>
            <select class="form-select" id="user_id" name="user_id" required>
              <option value="">Select Customer</option>
              <?php if(isset($customer_list)) foreach($customer_list as $customer): ?>
                <option value="<?php echo $customer['id']; ?>"
                        <?php echo (isset($sale_data['user_id']) && $sale_data['user_id'] == $customer['id']) ? 'selected' : ''; ?>>
                  <?php echo $customer['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <!-- Sale Details -->
        <div class="row mb-4">
          <div class="col-md-12">
            <label class="form-label" for="description">Description/Notes</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($sale_data['description']) ? $sale_data['description'] : ''; ?></textarea>
          </div>
        </div>

        <!-- Products Section -->
        <div class="row mb-4">
          <div class="col-md-12">
            <h6>Products</h6>
            <div id="products-container">
              <div class="product-row row mb-2">
                <div class="col-md-3">
                  <select class="form-select product-select" name="products[0][product_id]">
                    <option value="">Select Product</option>
                    <?php if(isset($product_list)) foreach($product_list as $product): ?>
                      <option value="<?php echo $product['id']; ?>" data-rate="<?php echo $product['sales_price']; ?>" data-tax="<?php echo $product['tax_id'] ?? 0; ?>" data-name="<?php echo $product['name']; ?>">
                        <?php echo $product['name']; ?> (₹<?php echo number_format($product['sales_price'], 2); ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <input type="hidden" name="products[0][product_id]" class="product-id">
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
                      <option value="<?php echo $tax['id']; ?>" data-percentage="<?php echo $tax['percentage']; ?>">
                        <?php echo $tax['name']; ?> (<?php echo $tax['percentage']; ?>%)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2">
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
        <input type="hidden" name="hdn_saleid" value="<?php echo isset($sale_data['id']) ? $sale_data['id'] : ''; ?>">
        <input type="hidden" name="subtotal" id="subtotal-input" value="0">
        <input type="hidden" name="tax_amount" id="tax-input" value="0">
        <input type="hidden" name="total" id="total-input" value="0">

        <!-- Action Buttons -->
        <div class="row">
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary me-2">
              <i class="ti ti-device-floppy me-1"></i><?php echo isset($sale_data) ? 'Update Sale' : 'Save Sale'; ?>
            </button>
            <a href="<?php echo site_url('Sales'); ?>" class="btn btn-label-secondary">
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
function initSalePage() {
  var productIndex = 1;

  // Generate sale number
  generateSaleNumber();

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

  // Product selection change
  $(document).on('change', '.product-select', function() {
    console.log('Product selection changed');
    var row = $(this).closest('.product-row');
    var selectedOption = $(this).find('option:selected');
    var rate = parseFloat(selectedOption.data('rate')) || 0;
    var taxId = parseInt(selectedOption.data('tax')) || 0;
    var productId = $(this).val();
    var productName = selectedOption.data('name') || '';

    console.log('Selected product:', productName, 'Rate:', rate, 'Tax ID:', taxId);

    // Update hidden input with product ID
    row.find('.product-id').val(productId);
    row.find('.rate').val(rate.toFixed(2));

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

  function generateSaleNumber() {
    $.ajax({
      url: '<?php echo site_url('Sales/generate_number'); ?>',
      type: 'GET',
      success: function(response) {
        if (response && response.sale_no) {
          $('#order_no').val(response.sale_no);
          console.log('Generated sale number:', response.sale_no);
        } else {
          console.error('Invalid response format for sale number:', response);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error generating sale number:', status, error);
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

      if (rate > 0) {
        row.find('.rate').val(rate.toFixed(2));
        calculateRowTotal(row);
      }
    }
  });

  console.log('Sale page initialized');
}

// Make sure jQuery is loaded before running our code
if (typeof jQuery !== 'undefined') {
  $(document).ready(function() {
    initSalePage();
  });
} else {
  // If jQuery is not ready, wait for it
  document.addEventListener('DOMContentLoaded', function() {
    // Check every 100ms if jQuery is loaded
    var checkJQuery = setInterval(function() {
      if (typeof jQuery !== 'undefined' && typeof $ !== 'undefined') {
        clearInterval(checkJQuery);
        initSalePage();
      }
    }, 100);
  });
}
</script>