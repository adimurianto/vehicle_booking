$(document).ready(function(){
    $('#form').validate({
        ignore: [],
        errorElement: 'span',
        errorPlacement: function(error, e) {
          $(e).parents('.form-group .col-12').find(".error-field-msg").append(error);
        },
        highlight: function(e) {
          $(e).closest('.form-group .col-12').removeClass('error-field').addClass('error-field');
        },
        success: function(e) {
          $(e).closest('.form-group .col-12').removeClass('error-field');
          $(e).remove();
        },
        rules: {
            'login_email':{
              required: true,
              email: true
            },
            'login_password':{
              required: true
            }
        },
        submitHandler: function(e){
          $.ajax({
            url: BaseUrl+"Authentication/loginProcess",
            method: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            beforeSend: function(){
              toggleLoader($("#crud-loader"),"show");
            },
            success: function(data){
              toggleLoader($("#crud-loader"),"hide");

              if(data.status){
                codehubalert("Login berhasil, silahkan tunggu...","success");
                setTimeout(function(){
                    window.location.replace(data.msg);
                },500);
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
});