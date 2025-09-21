<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl">
    <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
      <div>
        © 2024 Developed by <a href="#" target="_blank" class="fw-semibold">Agaval</a>
      </div>
      <div>
        <a href="#" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
      </div>
    </div>
  </div>
</footer>

<div class="content-backdrop fade"></div>
</div>
</div>
</div>

<div class="layout-overlay layout-menu-toggle"></div>

<div class="drag-target"></div>
</div>



<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/js/bootstrap.js" crossorigin="anonymous"></script>

<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/toastr/toastr.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/js/menu.js"></script>
<?php if ($chart_enable == 'Y') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<?php } ?>
<?php if ($data_table_enable == 'Y') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
<?php } ?>
<?php if ($export_enable == 'Y') { ?>

<?php } ?>
<?php if ($select2_enable == 'Y') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.js"></script>
<?php } ?>
<?php if ($segment == 'permission') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/js/app-access-permission.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/js/modal-add-permission.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/js/modal-edit-permission.js"></script>
<?php } ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.24/jquery.autocomplete.min.js'></script>
<script src="<?php echo base_url(); ?>/public/assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/js/common.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/js/listing.js"></script>

<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>

<?php if ($controller == 'User') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
  <script src="<?php echo base_url(); ?>/public/assets/js/user.js"></script>

<?php } ?>
<?php if ($controller == 'Customer' || $controller == 'Suppliers') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/js/customer.js"></script>
<?php } ?>
<script src="<?php echo base_url(); ?>/public/assets/js/setting.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<?php if ($controller == 'Sales') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/js/sales.js"></script>
  <script>
    $(function() {
      sales.listing();
    });
  </script>
<?php } ?>
<?php if ($controller == 'Product') { ?>
  <script src="<?php echo base_url(); ?>/public/assets/js/product.js"></script>
  <script>
    product.listing();
    product.category_list();
  </script>
<?php } ?>
<?php if (session()->getFlashdata('success_msg') != '') : ?>
  <script>
    common.toastr('success_msg', '<?php echo session()->getFlashdata('success_msg'); ?>');
  </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error_msg') != '') : ?>
  <script>
    common.toastr_popup('error_msg', '<?php echo session()->getFlashdata('error_msg'); ?>');
  </script>
<?php endif; ?>
<script src="<?php echo base_url(); ?>/public/assets/js/dashboards-ecommerce.js"></script>

<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/flatpickr/flatpickr.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/flatpickr/flatpickr.css" />


<script>
  $(function() {
    <?php if ($controller == 'Site' && $segment == 'tax') { ?>
      setting.tax_listing();
    <?php } ?>
    <?php if ($controller == 'Site' && $segment == 'units') { ?>
      setting.unit_listing();
    <?php } ?>
    <?php if ($controller == 'User' && $segment == 'list') { ?>
      user.listing();
    <?php } ?>
    <?php if ($controller == 'Customer') { ?>
      customer.listing();
    <?php } ?>
    <?php if ($controller == 'Suppliers') { ?>
      customer.supplier_list();
    <?php } ?>

    const flatpickrDate = document.querySelector('#user_birth_date');
    // Date
    if (flatpickrDate) {
      flatpickrDate.flatpickr({
        monthSelectorType: 'static',
        maxDate: new Date(Date.now() - 3600 * 1000 * 78840),
        dateFormat: 'd-m-Y'
      });
    }

    const expenses_date = document.querySelector('#expenses_date');
    // Date
    if (expenses_date) {
      expenses_date.flatpickr({
        monthSelectorType: 'static',
        dateFormat: 'd-m-Y'
      });
    }
  });
</script>
</body>

</html>