<!DOCTYPE html>
<html lang="en">

<head>
	<base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url(); ?>font/iconsmind/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css" />
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">
                            <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>
                            <p class="text-white mb-0">Yes, it is indeed!</p>
                        </div>
                        <div class="form-side">
                            <div class="text-center">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>img/logo-default.png">
                                </a>

                                <h6 class="my-4">Ooops... looks like an error occurred!</h6>
                                <p class="mb-0 text-muted text-small mb-0">Error code</p>
                                <p class="display-1 font-weight-bold mb-5">
                                    404
                                </p>
                                <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-lg btn-shadow">GO BACK HOME</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo base_url(); ?>js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>js/dore.script.js"></script>
    <script src="<?php echo base_url(); ?>js/scripts.js"></script>
</body>

</html>