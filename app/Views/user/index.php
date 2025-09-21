
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
                include 'list.php';
            } elseif ($segment == "permission") {
                include 'permission.php';
            } elseif ($segment == "list") {
                include 'list.php';
            } elseif ($segment == "role") {
                include 'role.php';
            } 
            elseif ($segment == "add") {
                include 'user_add.php';
            } elseif ($segment == "role_permission") {
                include 'role_permission.php';
            } else {
                include 'list.php';
            }
            ?>          
          
          <!-- / Content -->

          <?php include("{$base_dir}{$ds}common/footer.php"); ?>

