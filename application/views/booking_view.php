<main id="main-container">
   <div class="content">
      <div class="block">
         <div class="block-header block-header-default">
            <h3 class="block-title"><?php echo $title ?> </h3>
            <?php if ($btnAccess->adds != 0) : ?>
               <button id="btn-add" class="btn btn-primary float-right"  type="button">+ Tambah Data</button>
            <?php endif; ?>
            
            <button id="export-excel" class="btn btn-success float-right ml-2"  type="button"> <i class="fa fa-file-excel-o"></i> Export Excel</button>
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
                     <th>Booking ID</th>
                     <th>Nama Pemesan</th>
                     <th>Keterangan</th>
                     <th>Tanggal Mulai</th>
                     <th>Tanggal Akhir</th>
                     <th>Nama Driver</th>
                     <th>Plat Kendaraan</th>
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
                           <label for="vehicle_id">Kendaraan</label>
                           <select id="vehicle_id" name="vehicle_id" class="form-control">
                              <?php foreach ($vehicles as $vehicle) : ?>
                                <option value="<?php echo $vehicle->id ?>"><?php echo $vehicle->plate_number . ' - ' . ucwords($vehicle->type) ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     
                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="driver_id">Driver</label>
                           <select id="driver_id" name="driver_id" class="form-control">
                              <?php foreach ($drivers as $driver) : ?>
                                <option value="<?php echo $driver->id ?>"><?php echo $driver->name ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="requester_name">Nama Pemesan</label>
                           <input type="text" id="requester_name" class="form-control" name="requester_name">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="purpose">Keterangan</label>
                           <input type="text" id="purpose" class="form-control" name="purpose">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="start_date">Tanggal Mulai</label>
                           <input type="date" id="start_date" class="form-control" name="start_date">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="end_date">Tanggal Akhir</label>
                           <input type="date" id="end_date" class="form-control" name="end_date">
                           <div class="error-field-msg mt-2"></div>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="approver1">Approver 1</label>
                           <select id="approver1" name="approver1" class="form-control">
                              <?php foreach ($approvers as $user) : ?>
                                <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-md-12">
                           <label for="approver2">Approver 2</label>
                           <select id="approver2" name="approver2" class="form-control">
                              <?php foreach ($approvers as $user) : ?>
                                <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
                              <?php endforeach; ?>
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