    <div class="modal fade" id="modal-crud-account" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title title-form">+ Ubah Akun</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <!-- FORM -->
                    <form class="form" id="form_update_account" method="POST">
                        <div class="block-content">
                            <input type="hidden" id="id_account" name="id_account" value="">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name_account">Nama Admin</label>
                                    <input type="text" class="form-control" id="name_account" name="name_account">
                                    <div class="error-field-msg mt-2"></div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="">Jenis Kelamin</label>
                                </div>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="gender_account" id="gender_account1" value="laki-laki" checked="">
                                            <label class="custom-control-label" for="gender_account1">Laki-laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="gender_account" id="gender_account2" value="perempuan">
                                            <label class="custom-control-label" for="gender_account2">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="error-field-msg mt-2"></div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="email_account">Email</label>
                                    <input type="text" class="form-control" id="email_account" name="email_account" readonly>
                                    <div class="error-field-msg mt-2"></div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="phonenumber_account">No Telp</label>
                                    <input type="text" class="form-control" id="phonenumber_account" name="phonenumber_account">
                                    <div class="error-field-msg mt-2"></div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="address_account">Alamat</label>
                                    <textarea name="address_account" class="form-control" id="address_account" rows="4"></textarea>
                                    <div class="error-field-msg mt-2"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-alt-success">
                                <i class="fa fa-check"></i> Simpan
                            </button>
                        </div>
                        
                        <div class="loader-wrapper" id="crud-loader-account">
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
                    <!-- /FORM -->
                </div>
            </div>
        </div>
    </div>
                
            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-sm clearfix">
                    <div class="float-right">
                    © 2026 Adi Murianto. All rights reserved.
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
    
        
        <script src="<?php echo base_url("assets/temp_backend/js/core/jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/codebase.core.min.js") ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/bootstrap.bundle.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/temp_backend/js/core/simplebar.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/datatables.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/pdfmake.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/vendor/datatable/js/pdfmake_vfs_fonts.min.js"); ?>"></script>
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

        <script src="<?php echo base_url("assets/temp_backend/js/codebase.app.min.js") ?>"></script>

        <script src="<?php echo base_url("assets/js/script.js"); ?>"></script>
        <script type="text/javascript">
            var BaseUrl = '<?php echo base_url(); ?>';
            var segment1 = "<?php echo ($this->uri->segment(1)) ? $this->uri->segment(1) : ""; ?>";
        </script>

        <?php
            if (isset($scripts)) {
                foreach ($scripts as $script) {
                    echo '<script src="' . base_url($script) . '"></script>';
                }
            }
        ?>
    </body>
</html>