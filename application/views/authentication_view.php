<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Vehicle Booking</title>

        <meta name="description" content="English Course, Test English, Learning English">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <link rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('assets/temp_backend/css/codebase.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">

        <link rel="stylesheet" href="<?php echo base_url("assets/vendor/typicon/typicons.min.css"); ?>">
    </head>
    <body>
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-gd-dusk">
                    <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                        <!-- Header -->
                        <div class="py-30 px-5 text-center">
                            <!-- <a class="link-effect font-w700" href="index.html">
                                <span class="font-size-xl text-primary-dark">Adi Murianto</span></span>
                            </a> -->
                            <h1 class="h2 font-w700 mt-50 mb-10">Vehicle Booking</h1>
                            <h2 class="h4 font-w400 text-muted mb-0">Akun Masuk</h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <div class="row justify-content-center px-5">
                            <div class="col-sm-8 col-md-6 col-xl-4">
                                <form class="form" method="POST" id="form">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" id="login-email" name="login_email" autocomplete="false" class="form-control">
                                                <label for="login-email">Email</label>
                                            </div>
                                            <div class="error-field-msg mt-2" style="color: red;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="login-password" name="login_password" autocomplete="off">
                                                <label for="login-password">Kata Sandi</label>
                                            </div>
                                            <div class="error-field-msg mt-2" style="color: red;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row gutters-tiny">
                                        <div class="col-12 mb-10">
                                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                                <i class="si si-login mr-10"></i> Masuk
                                            </button>
                                        </div>
                                    </div>

                                    <div class="loader-wrapper" id="crud-loader" style="left:0;">
                                        <div class="loader-bars">
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                            <div class="loader-bar"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        
        <script src="<?php echo base_url("assets/temp_backend/js/core/jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/bootstrap.bundle.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/pdfmake.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/pdfmake_vfs_fonts.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/datatables.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/simplebar.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/jquery-scrollLock.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/jquery.appear.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/jquery.countTo.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/js.cookie.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/popperjs/popper.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"); ?>"></script>
        
        <script src="<?php echo base_url("assets/vendor/sweetalert2/sweetalert2.all.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/ajaxform/ajaxform.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/jquery-validation/jquery.validate.min.js"); ?>"></script>
        <script href="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js"></script>

        <!-- <script src="<?php echo base_url() ?>assets/temp_backend/js/codebase.core.min.js"></script> -->
        <script src="<?php echo base_url("assets/temp_backend/js/codebase.app.min.js") ?>"></script>

        <script src="<?php echo base_url("assets/temp_backend/js/pages/op_auth_signin.min.js") ?>"></script>
        <script src="<?php echo base_url("assets/js/authentication.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/script.js"); ?>"></script>
        <script type="text/javascript">
            var BaseUrl = '<?php echo base_url(); ?>';
            var segment1 = "<?php echo ($this->uri->segment(1)) ? $this->uri->segment(1) : ""; ?>";
        </script>
    </body>
</html>