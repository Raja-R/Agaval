<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="<?php echo base_url(); ?>/public/assets/img/illustrations/auth-register-illustration-light.png" alt="auth-register-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-register-illustration-light.png" data-app-dark-img="illustrations/auth-register-illustration-dark.png" />

                <img src="<?php echo base_url(); ?>/public/assets/img/illustrations/bg-shape-image-light.png" alt="auth-register-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
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
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form id="formAuthentication" class="mb-3" action="<?= url_to('register') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label for="email"><?= lang('Auth.email') ?></label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" autofocus>
                        <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="username"><?= lang('Auth.username') ?></label>
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group mb-3 d-block">
                        <label for="password"><?= lang('Auth.password') ?></label>
                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                    </div>

                    <div class="form-group mb-3 d-block">
                        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                    </div>


                    <button type="submit" class="btn btn-primary d-grid w-100"><?= lang('Auth.register') ?></button>
                </form>

                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="<?= url_to('login') ?>">
                        <span><?= lang('Auth.signIn') ?></span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>


<?= $this->endSection() ?>