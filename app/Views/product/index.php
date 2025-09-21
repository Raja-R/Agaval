<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
?>

<?php include("{$base_dir}{$ds}common/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/dropzone/dropzone.css">
<style>

table.dataTable>tbody>tr.child ul.dtr-details {
    width: 100%;
}

table.dataTable>tbody>tr.child span.dtr-title {
    min-width: 15%;
}

table.dataTable>tbody>tr.child span.dtr-data {
    display: inline-block;
}
</style>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include("{$base_dir}{$ds}common/sidebar.php"); ?>

      <!-- Layout container -->
      <div class="layout-page">
        <?php include("{$base_dir}{$ds}common/navbar.php"); ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <?php
          if ($segment == "") {
            include 'list.php';
          } elseif ($segment == "add") {
            include 'add.php';
          } elseif ($segment == "update") {
            include 'add.php';
          } elseif ($segment == "view") {
            include 'view.php';
          } elseif ($segment == "category") {
            include 'category.php';
          } elseif ($segment == "category_add" || $segment == "category_update") {
            include 'category_add.php';
          } else {
            include 'list.php';
          }
          ?>

          <!-- / Content -->

          <?php include("{$base_dir}{$ds}common/footer.php"); ?>

          <script src="<?php echo base_url(); ?>/public/assets/js/product.js"></script>
          <script>
            product.listing();
            product.category_list();
          </script>
    
    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/menu.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/js/forms-file-upload.js"></script>

