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
                     <th>Nomor Plat</th>
                     <th>Jenis Angkutan</th>
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
                           <label for="plate_number">Nomor Plat</label>
                           <input type="text" id="plate_number" class="form-control" name="plate_number">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="type">Jenis Angkutan</label>
                           <select id="type" name="type" class="form-control">
                              <option value="orang">Orang</option>
                              <option value="barang">Barang</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="ownership">Pemilik Kendaraan</label>
                           <select id="ownership" name="ownership" class="form-control">
                              <option value="perusahaan">Perusahaan</option>
                              <option value="sewa">Sewa</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="location_id">Lokasi</label>
                           <select id="location_id" name="location_id" class="form-control">
                              <?php foreach ($locations as $loc) : ?>
                                <option value="<?php echo $loc->id ?>"><?php echo $loc->name ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="status">Status</label>
                           <select id="status" name="status" class="form-control">
                              <option value="available">Available</option>
                              <option value="maintenance">Maintenance</option>
                              <option value="used">Used</option>
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