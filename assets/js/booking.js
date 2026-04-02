$(document).ready(function(){
  var table;
  var save_method = "add";

    $("#btn-deleted").prop('disabled',true);
    $("#delete_all").prop("checked",false);

    $('#btn-add').click(function(e){
        e.preventDefault();
        save_method = "add";
        $('.title-form').text("+ Tambah Data");
        $('.form-group .col-md-12').removeClass("active error-field");
        $('.error-field-msg').text("");
        $('#form')[0].reset();
        toggleLoader($("#crud-loader"),"hide");
        $('select[name="approver1"]').prop('disabled',false);
        $('select[name="approver2"]').prop('disabled',false);
        $('#modal-crud').modal('show');
    });

    $(document).on('click','.btn-update', function(){
      var _ = $(this);
      $('.title-form').text("Ubah Data");
      var id = _.attr('data-id');
      getById(id);
    });

    $(document).on('change','.delete-data',function(e){
      var all = $('.delete-data').length;
      var counter = $('.delete-data').filter(':checked').length;
      if(counter > 0){
        $('#btn-deleted').removeAttr('disabled');
      }else{
        $('#btn-deleted').attr('disabled','disabled');
      }
      if(counter == all){
        $('#delete_all').prop('checked',true);
      }else{
        $('#delete_all').prop('checked',false);
      }
    });

    $("#btn-deleted").click(function(e){
      e.preventDefault();
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Ingin menghapus data yang dipilih",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
      }).then((result) => {
        if (result.value) {
          deletedData();
        }
      });
    });

    $('#delete_all').click(function(e){
      if(this.checked) {
        $('.delete-data').each(function () { //loop through each checkbox
          $(this).prop('checked', true); //check
        });
      }else{
        $('.delete-data').each(function () { //loop through each checkbox
          $(this).prop('checked', false); //uncheck
        });
      }
      $('.delete-data').change();
    });

    function deletedData(){
      $.ajax({
        url: BaseUrl+"Booking/deleteData/",
        method: "POST",
        data: $('.delete-data:checked').serialize(),
        dataType: "JSON",
        beforeSend: function(){
        },
        success: function(data){
          if(data.status){
            reload_table();
            $('#delete_all').prop('checked', false).change(); //uncheck
            $('#btn-deleted').prop('disabled', true);
            codehubalert(data.msg,'success');
          }else{
            codehubalert(data.msg,'error');
          }
        },
        error: function(jqXHR,textStatus,errorThrown){
          codehubalert('Terjadi kesalahan pada server','error');
        }
      });
    }

    function getById(id){
        $.ajax({
          url: BaseUrl+"Booking/getbyid",
          method: "POST",
          data: {id:id},
          dataType: "JSON",
          beforeSend: function(){

          },
          success: function(data){
            save_method = "update";
            $('.form-group .col-md-12').removeClass("active error-field");
            $('.error-field-msg').text("");
            $('#form')[0].reset();

            if(data != null){
              $('input[name="id"]').val(data.id);
              $('select[name="vehicle_id"] option[value="'+data.vehicle_id+'"').prop('selected',true);
              $('select[name="driver_id"] option[value="'+data.driver_id+'"').prop('selected',true);
              $('input[name="requester_name"]').val(data.requester_name);
              $('input[name="purpose"]').val(data.purpose);
              $('input[name="start_date"]').val(new Date(data.start_date).toISOString().split('T')[0]);
              $('input[name="end_date"]').val(new Date(data.end_date).toISOString().split('T')[0]);
              $('select[name="approver1"] option[value="'+data.approver1+'"').prop('selected',true);
              $('select[name="approver2"] option[value="'+data.approver2+'"').prop('selected',true);    

              $('select[name="approver1"]').prop('disabled',true);
              $('select[name="approver2"]').prop('disabled',true);

              toggleLoader($("#crud-loader"),"hide");
              $('#modal-crud').modal('show');
            }else{
              codehubalert("Data tidak ditemukan","error");
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            codehubalert("Terjadi kesalahan pada server","error");
          }
        })
    }

    function reload_table(){
      table.ajax.reload(null, false);
    }

    $('#export-excel').click(function () {
      var date = new Date().toISOString().split('T')[0];
      var filename = 'report_booking_' + date + ".xlsx";

      var table = document.getElementById('dataTable');

      var data = [];
      for (let i = 0; i < table.rows.length; i++) {
          let row = [];
          for (let j = 0; j < table.rows[i].cells.length; j++) {
              row.push(table.rows[i].cells[j].innerText);
          }

          row.shift();
          row.pop();

          data.push(row);
      }

      var ws = XLSX.utils.aoa_to_sheet(data);

      var wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

      XLSX.writeFile(wb, filename);
    });

    $('#form').validate({
        ignore: [],
        errorElement: 'span',
        errorPlacement: function(error, e) {
          $(e).parents('.form-group .col-md-12').find(".error-field-msg").append(error);
        },
        highlight: function(e) {
          $(e).closest('.form-group .col-md-12').removeClass('error-field').addClass('error-field');
        },
        success: function(e) {
          $(e).closest('.form-group .col-md-12').removeClass('error-field');
          $(e).remove();
        },
        rules: {
            'vehicle_id':{
              required: true
            },
            'driver_id':{
              required: true
            },  
            'requester_name':{
              required: true
            },  
            'purpose':{
              required: true
            },  
            'start_date':{
              required: true
            },  
            'end_date':{
              required: true
            },
        },
        submitHandler: function(e){
          var url;
          if(save_method == "add"){
            url = BaseUrl+"Booking/addData";
          }else{
            url = BaseUrl+"Booking/updateData";
          }

          $.ajax({
            url: url,
            method: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            beforeSend: function(){
              toggleLoader($("#crud-loader"),"show");
            },
            success: function(data){
              toggleLoader($("#crud-loader"),"hide");

              if(data.status){
                reload_table();
                codehubalert(data.msg,"success");
                $('#modal-crud').modal('hide');
              }else{
                codehubalert(data.msg,"error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown){
              toggleLoader($("#crud-loader"),"hide");
              codehubalert("Terjadi kesalahan, cobalagi nanti","error");
            }
          });
        }
      });


      table = $('#dataTable').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "responsive": true,
        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
        // So when dropdowns used the scrollable div should be removed.
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        "dom": '<"mb-3"<"pull-left"l><"pull-right"f><"clearfix">><rt><"mt-3"<"pull-left"i><"pull-right"p>><"clearfix">',
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
        "length": [
          [10, 20, 50, 100, 150, -1],
          [10, 20, 50, 100, 150, "All"] // change per page values here
        ],
    
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": BaseUrl+"Booking/getData",
          "type": "POST"
        },
        "columnDefs": [{
          "targets": [0,-1],
          "orderable": false,
        }],
        "createdRow": function( row, data, dataIndex ) {
          // Add a class to the cell in the second column
          $(row).find("td").css("vertical-align","middle");
        },
        "order": [],
        drawCallback: function () {
            $('.page-link').css({
              "border": "none",
              "padding-left": "1.5rem",
              "padding-right": "1.5rem",
              "border-radius": "8px"
          });
          $('.page-item').css({
              "height": "auto",
              "margin": "0 4px",
              "padding": "0 0"
          });

          $('ul.pagination').addClass("mt-2");
          $('.dataTables_filter').addClass("float-right");
        },
      });
});