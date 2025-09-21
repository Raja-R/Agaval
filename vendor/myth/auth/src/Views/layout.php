<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?php echo base_url(); ?>/public/assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Agaval POS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/public/assets/img/favicon/logo_small.png" />



    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/style.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url(); ?>/public/assets/js/config.js"></script>
    <style>
        .app-brand-logo.demo {

            display: -ms-flexbox;
            display: flex;
            width: 250px;
            height: 150px;
        }
    </style>
</head>

<body>

    <?= $this->renderSection('main') ?>


    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="<?php echo base_url(); ?>/public/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="<?php echo base_url(); ?>/public/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php echo base_url(); ?>/public/assets/js/pages-auth.js"></script>
</body>

</html>