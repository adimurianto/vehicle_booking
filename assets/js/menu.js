$(document).ready(function(){
    var table;
    var save_method = "add";
    var currentId = "";
    var currentLevel = "";
  
      $("#btn-deleted").prop('disabled',true);
      $("#delete_all").prop("checked",false);
      $("#submenu-parent").hide();
  
      $('#btn-add').click(function(e){
          e.preventDefault();
          save_method = "add";
          currentId = "";
          currentLevel = "";
          $('#popup-title').text("+ Tambah Data");
          $('.form-group .col-md-12').removeClass("active error-field");
          $('.error-field-msg').text("");
          $('#form')[0].reset();
          $('#level').change();
          toggleLoader($("#crud-loader"),"hide");
          $('#modal-crud').modal('show');
      });
  
      $(document).on('click','.btn-update', function(){
        var _ = $(this);
        $('#popup-title').text("Ubah Data");
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

      $('#level').change(function(e){
        var _ = $(this);
        if(_.val() == '2'){
          if(save_method == 'add'){
            getcurrentsort('',_.val());
          }
          submenu('1');
          $('#submenu-parent').show();
        }else{
          if(save_method == 'add'){
            getcurrentsort('',_.val());
          }
          $('#submenu-parent').hide();
        }
      });
    
      $('#menu_sub').change(function(e){
        var _ = $(this);
        if(save_method == 'add'){
          getcurrentsort(_.val(),'');
        }
      });
  
      function deletedData(){
        $.ajax({
          url: BaseUrl+"Menu/deleteData/",
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
            url: BaseUrl+"Menu/getbyid",
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
                currentId = data.id;
                currentLevel = data.level;
                $('input[name="id"]').val(data.id);
                $('input[name="name"]').val(data.name);
                $('input[name="icon"]').val(data.icon);
                $('input[name="url"]').val(data.url);
                $('input[name="sort"]').val(data.sort);
                $('select[name="level"] option[value="'+data.level+'"').prop('selected',true);
                $('select[name="level"]').change();
                $('select[name="status"] option[value="'+data.status+'"').prop('selected',true);
  
                if(data.name.length > 0){
                  $('input[name="name"]').parent().addClass("active");
                }
                if(data.icon.length > 0){
                  $('input[name="icon"]').parent().addClass("active");
                }
                if(data.url.length > 0){
                  $('input[name="url"]').parent().addClass("active");
                }
                if(data.sort.length > 0){
                    $('input[name="sort"]').parent().addClass("active");
                }

                toggleLoader($("#crud-loader"),"hide");

                setTimeout(function(){
                    if($('select[name="menu_sub"] option[value="'+data.parent+'"]').length > 0){
                        $('select[name="menu_sub"] option[value="'+data.parent+'"]').prop('selected',true).change();
                    }else{
                        var submenuValue = $('#menu_sub option[value=""').val();
                        if(submenuValue != ""){
                            $('#menu_sub').append('<option value="'+data.parent+'" selected>Tidak ada sub menu</option>');
                        }
                    }
                    $('#modal-crud').modal('show');
                  }, 200);
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

      function getcurrentsort(id,level){
        $.ajax({
          url: BaseUrl+'Menu/getCurrentSort',
          type: 'POST',
          data: {id:id,level:level},
          dataType: 'JSON',
          beforeSend: function(){
    
          },
          success: function(data){
            if(data.status){
              $('input[name="sort"]').val(data.sort);
              $('input[name="sort"]').parent().addClass("active");
            }else{
              cocoalert(data.msg,'error');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            cocoalert('Terjadi kesalahan pada server','error');
          }
        });
      }
    
      function submenu(level){
        $.ajax({
          url: BaseUrl+"Menu/getSubMenu/",
          method: "POST",
          data: {"level":level},
          dataType: "JSON",
          beforeSend: function(){
          },
          success: function(response){
            if(response.status){
              var counter = 0;
              $('#menu_sub').find('option').remove();
              $.each(response.data, function(index,data){
                counter++;
                if(currentLevel == "1"){
                    if(currentId != data['id']){
                        $('#menu_sub').append('<option value="'+data['id']+'">'+data['name']+'</option>');    
                    }else{
                        if(response.data.length <= 1){
                            $('#menu_sub').html('<option value="">Tidak ada sub menu</option>');            
                        }
                    }
                }else{
                    $('#menu_sub').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                }
              });

              if(counter == 0){
                $('#menu_sub').html('<option value="">Tidak ada sub menu</option>');
              }
              $('#menu_sub').change();
              $('#submenu-parent').show();
            }else{
              cocoalert(response.msg,'error');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            cocoalert('Terjadi kesalahan pada server','error');
          }
        });
      }
  
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
              'name':{
                required: true
              },
              'url':{
                required: true
              },
              'sort':{
                required: true,
                number:true
              }
          },
          submitHandler: function(e){
            var url;
            if(save_method == "add"){
              url = BaseUrl+"Menu/addData";
            }else{
              url = BaseUrl+"Menu/updateData";
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
          "url": BaseUrl+"Menu/getData",
          "type": "POST"
        },
        "columnDefs": [{
          "targets": [0, 2,-1],
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