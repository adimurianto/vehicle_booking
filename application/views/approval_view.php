<main id="main-container">
   <div class="content">
      <div class="block">
         <div class="block-header block-header-default">
            <h3 class="block-title"><?php echo $title ?> </h3>
         </div>
         <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" style="width: 100%; overflow: auto;" id="dataTable">
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
                     <?php if($sess_role == 'Approver'){ ?>
                        <th>Approve</th>
                     <?php }else{ ?>
                        <th>Approver</th>
                     <?php } ?>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>

</main>