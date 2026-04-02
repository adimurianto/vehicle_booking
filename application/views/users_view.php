<main id="main-container">
   <div class="content">
      <div class="block">
         <div class="block-header block-header-default">
            <h3 class="block-title"><?php echo $title ?> </h3>
            <?php if ($btnAccess->adds != 0) : ?>
               <button id="btn-add" class="btn btn-primary float-right"  type="button">+ Tambah Data</button>
            <?php endif; ?>
         </div>
         <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="dataTable">
               <thead>
                  <tr>
                     <th>
                     <?php if ($btnAccess->deleted != 0) : ?>
                        <div class="checkbox-wrap">
                           <label for="delete_all">
                              <input type="checkbox" id="delete_all" name="delete_all">
                           </label>                          
                        </div>
                     <?php else: ?>
                        <center>-</center>
                     <?php endif; ?>
                     </th>
                     <th>Nama</th>
                     <th>Email</th>
                     <th>Level</th>
                     <th>Status</th>
                     <th>Opsi</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
            <?php if ($btnAccess->deleted != 0) : ?>
               <button id="btn-deleted" class="btn btn-danger" type="button" disabled>
                  <i class="fa fa-trash-o"></i>
                  Hapus
               </button>
            <?php endif; ?>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modal-crud" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
               <div class="block-header bg-primary-dark">
                  <h3 class="block-title title-form">+ Tambah Data</h3>
                  <div class="block-options">
                     <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                        <i class="si si-close"></i>
                     </button>
                  </div>
               </div>
               <!-- FORM -->
               <form class="form" id="form" method="POST">
                  <div class="block-content">
                     <input type="hidden" id="id" name="id">
                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="name">Nama Admin</label>
                           <input type="text" id="name" class="form-control" name="name">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>   
                        
                     <div class="form-group row">
                        <div class="col-lg-12">
                           <label for="">Jenis Kelamin</label>
                        </div>
                        <div class="col-12">
                           <div class="custom-control custom-radio custom-control-inline mb-5">
                                 <input class="custom-control-input" type="radio" name="gender" id="gender1" value="laki-laki" checked="">
                                 <label class="custom-control-label" for="gender1">Laki-laki</label>
                           </div>
                           <div class="custom-control custom-radio custom-control-inline mb-5">
                                 <input class="custom-control-input" type="radio" name="gender" id="gender2" value="perempuan">
                                 <label class="custom-control-label" for="gender2">Perempuan</label>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="name">Email</label>
                           <input type="text" id="email" class="form-control" name="email">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="name">No Telp</label>
                           <input type="text" id="phonenumber" class="form-control" name="phonenumber">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="name">Alamat</label>
                           <textarea name="address" id="address" class="form-control" rows="4"></textarea>
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="name">Kata sandi</label>
                           <input type="password" id="password" class="form-control"name="password">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="level">Akses Level</label>
                           <select id="level" name="level" class="form-control">
                              <?php foreach($group as $g){ ?>
                                 <option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="status">Status</label>
                           <select id="status" name="status" class="form-control">
                              <option value="1">Aktif</option>
                              <option value="0">Nonaktif</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Simpan
                     </button>
                  </div>
            
                  <div class="loader-wrapper" id="crud-loader">
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

</main>