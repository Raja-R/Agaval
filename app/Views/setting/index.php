
<?php 
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
?>

<?php include("{$base_dir}{$ds}common/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

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
                include 'setting.php';
            } elseif ($segment == "profile") {
                include 'profile.php';
            } elseif ($segment == "tax") {
                include 'tax.php';
            }
            elseif ($segment == "units") {
                include 'unit.php';
            } elseif ($segment == "role") {
                include 'role.php';
            } else {
                include 'setting.php';
            }
            ?>          
          
          <!-- / Content -->

          <?php include("{$base_dir}{$ds}common/footer.php"); ?>

