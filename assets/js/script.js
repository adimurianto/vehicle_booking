$(document).ready(function(){
  $('#toggle-navbar-desktop').click().removeClass('navigation-widget-trigger');
  getSidebar();

  $('.update-account').click(function(e){
    e.preventDefault();
    getaccount();
  });

  $('.btn-logout').click(function(e){
    e.preventDefault();
    var _ = $(this);
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Ingin keluar dari akun Anda?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak',
    }).then((result) => {
      if (result.value) {
        codehublogout();
      }
    });
  });

  $('#form_update_account').validate({
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
        'name_account':{
          required: true
        },
        'gender_account':{
          required: true
        },
        'phonenumber_account':{
          required: true,
          number:true
        },
        'address_account':{
          required: true
        },
    },
    submitHandler: function(e){
      $.ajax({
        url: BaseUrl+"Authentication/updateAccount",
        method: "POST",
        data: $('#form_update_account').serialize(),
        dataType: "JSON",
        beforeSend: function(){
          toggleLoader($("#crud-loader-account"),"show");
        },
        success: function(data){
          toggleLoader($("#crud-loader-account"),"hide");

          if(data.status){
            var account = data.account;
            
            $('#header-user-name').text(account.name);
            $('#sidebar-user-name').text(account.name);

            codehubalert(data.msg,"success");
            $('#modal-crud-account').modal('hide');
          }else{
            codehubalert(data.msg,"error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          toggleLoader($("#crud-loader-account"),"hide");
          codehubalert("Terjadi kesalahan, cobalagi nanti","error");
        }
      });
    }
  });

  function getaccount() {
    $.ajax({
        url: BaseUrl + "Authentication/getAccount",
        method: "POST",
        dataType: "JSON",
        beforeSend: function() {
        },
        success: function(data) {
          $('.form-group .col-md-12').removeClass("active error-field");
          $('.error-field-msg').text("");
          $('#form_update_account')[0].reset();

          if(data != null){
            $('input[name="id_account"]').val(data.id);
            $('input[name="name_account"]').val(data.name);
            $('input[name="email_account"]').val(data.email).prop('readonly',true);
            $('input[name="phonenumber_account"]').val(data.phonenumber);
            $('#address_account').val(data.address);
            $('input[name="gender_account"][value="'+data.gender+'"').prop('checked',true);

            if(data.name.length > 0){
              $('input[name="name_account"]').parent().addClass("active");
            }
            if(data.email.length > 0){
              $('input[name="email_account"]').parent().addClass("active");
            }
            if(data.phonenumber.length > 0){
              $('input[name="phonenumber_account"]').parent().addClass("active");
            }
            if(data.address.length > 0){
              $('#address_account').parent().addClass("active");
            }

            toggleLoader($("#crud-loader-account"),"hide");
            $('#modal-crud-account').modal('show');
          }else{
            codehubalert("Data tidak ditemukan","error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          codehubalert("Terjadi kesalahan pada server", "error");
        }
    });
}

function getSidebar() {
  $.ajax({
      url: BaseUrl + "Sidebar",
      method: "POST",
      data: {current_menu:segment1},
      dataType: "JSON",
      async:false,
      beforeSend: function() {},
      success: function(data) {
          $("#sidebar-desktop").html(data.large_sidebar);
          $("#sidebar-mobile").html(data.large_sidebar);
          $("#sidebar-desktop-small").append(data.small_sidebar);
          // app.plugins.createTooltip({
          //   container: '.text-tooltip-sidebar-custom',
          //   offset: 4,
          //   direction: 'right',
          //   animation: {
          //     type: 'translate-in-fade'
          //   }
          // });
      },
      error: function(jqXHR, textStatus, errorThrown) {
          cocoalert("Terjadi kesalahan pada server", "error");
      }
  });
}

  function codehublogout() {
    $.ajax({
        url: BaseUrl + "authentication/logout/",
        method: "POST",
        dataType: "JSON",
        beforeSend: function() {
        },
        success: function(data) {
            if (data.status) {
                window.location.replace(data.msg);
            } else {
                codehublert("Terjadi kesalahan pada server", "error");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          codehubalert("Terjadi kesalahan pada server", "error");
        }
    });
}
});

function toggleLoader(loader,visibility){
  if(visibility == "show"){
    loader.fadeIn(500);
  }else{
    loader.fadeOut(500);
  }
}

function codehubalert(msg,type){
  const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  toast({
    type: type,
    title: msg
  });
}

$('#page-header-user-dropdown').click(function(e){
  e.preventDefault();
  if($('.dropdown-account-admin').attr('show') == '0'){
    $('.dropdown-account-admin').attr('show', '1');
    $('.dropdown-account-admin').show();
  }else{
    $('.dropdown-account-admin').attr('show', '0');
    $('.dropdown-account-admin').hide();
  }
});

$('.dropdown-account-admin').on( "mouseleave", function() {
  setTimeout(function(){
    $('.dropdown-account-admin').attr('show', '0');
    $('.dropdown-account-admin').hide();
  }, 1000);
});