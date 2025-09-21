<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?php echo base_url(); ?>/public/assets/" data-template="vertical-menu-template-no-customizer">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Digital Dental</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/public/assets/img/logo_digital.png" />



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
  <!-- Content -->

  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="<?php echo base_url(); ?>/public/assets/img/illustrations/auth-login-illustration-light.png" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

          <img src="<?php echo base_url(); ?>/public/assets/img/illustrations/bg-shape-image-light.png" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="<?php echo base_url(); ?>/public/assets/img/logo_digital.png">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <h3 class="mb-1 fw-bold">Welcome to Digital Dental 👋</h3>
          <p class="mb-4">Please sign-in to your account</p>

          <form id="formAuthentication" class="mb-3" action="<?php echo site_url(); ?>Auth/login" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" autofocus />
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-cover.html">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Sign in</button>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-cover.html">
              <span>Create an account</span>
            </a>
          </p>



        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
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