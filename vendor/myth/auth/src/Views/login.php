<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<body>
	<!-- Content -->
	<div class="authentication-wrapper authentication-cover authentication-bg">
		<div class="authentication-inner row">
			<!-- /Left Text -->
			<div class="d-none d-lg-flex col-lg-7 p-0">
				<div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
					<img src="<?php echo base_url(); ?>/public/assets/img/layouts/bg_layout_login.jpg" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="<?php echo base_url(); ?>/public/assets/img/layouts/bg_layout_login.jpg" data-app-dark-img="<?php echo base_url(); ?>/public/assets/img/layouts/bg_layout_login.jpg" />

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
								<img src="<?php echo base_url(); ?>/public/assets/img/agaval_logo.png">
							</span>
						</a>
					</div>
					<!-- /Logo -->
					<h3 class="mb-1 fw-bold">Welcome to Agaval POS 👋</h3>
					<p class="mb-4">Please sign-in to your account</p>
					<?= view('Myth\Auth\Views\_message_block') ?>
					<form id="formAuthentication" class="mb-3" action="<?= url_to('login') ?>" method="POST">
						<?= csrf_field() ?>

						<?php if ($config->validFields === ['email']) : ?>
							<div class="mb-3 form-group d-block ">
								<label class="form-label" for="login"><?= lang('Auth.email') ?></label>
								<input type="email" id="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>" autofocus>
								<div class="invalid-feedback">
									<?= session('errors.login') ?>
								</div>
							</div>
						<?php else : ?>
							<div class="form-group mb-3 d-block ">
								<label for="login"><?= lang('Auth.emailOrUsername') ?></label>
								<input type="text" id="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" autofocus>

							</div>
						<?php endif; ?>


						<div class="mb-3 form-password-toggle">
							<?php if ($config->allowRegistration) : ?>
								<div class="d-flex justify-content-between">
									<label class="form-label" for="password"><?= lang('Auth.password') ?></label>
									<a href="<?= url_to('forgot') ?>">
										<small><?= lang('Auth.forgotYourPassword') ?></small>
									</a>
								</div>
							<?php endif; ?>
							<div class="input-group input-group-merge">
								<input type="password" id="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
								<span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
							</div>
						</div>
						<div class="invalid-feedback">
							<?= session('errors.password') ?>
						</div>
						<?php if ($config->allowRemembering) : ?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
									<?= lang('Auth.rememberMe') ?>
								</label>
							</div>
						<?php endif; ?>

						<button type="submit" class="btn btn-primary d-grid w-100"><?= lang('Auth.loginAction') ?></button>
					</form>


					<?php if ($config->allowRegistration) : ?>
						<p class="text-center">
							<span>Not register?</span>
							<a href="<?= url_to('register') ?>">
								<span><?= lang('Auth.needAnAccount') ?></span>
							</a>
						</p>
					<?php endif; ?>


				</div>
			</div>
			<!-- /Login -->
		</div>
	</div>


	<?= $this->endSection() ?>