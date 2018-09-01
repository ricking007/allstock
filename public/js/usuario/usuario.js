$(document).ready(function(){
    $('#form-usuario').on('submit',function(e){
       e.preventDefault();
       var data = $(this).serialize();
       var $form = $(this);
       var $bt = $(this).find('.btn-action-ajax');
       $.ajax({
           url : 'usuario/add/',
           method : 'post',
           data : data,
           beforeSend: function () {
               $bt.addClass('btn-spin');
               $('.form-group').removeClass('has-error');
               $('small.error,span.error').remove();
               
           }
       }).done(function(response){
           var $alert = $("#modal-alert");
           try {
                response = JSON.parse(response);
                if(response.success){
                    // se não for uma edição faz reset no form
                    if(!$("#id-usuario").length){ 
                        $form.get(0).reset();
                        $("#nome").focus();
                    }
                    $alert.removeClass('modal-error').addClass('modal-success');
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                } else {
                    //console.log(response.errors);
                    if(typeof(response.errors) != undefined){
                     $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                     });
                    }
                    $('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
           } catch (e){
                $alert.removeClass('modal-success').addClass('modal-error');
                $alert.find('.modal-body p').html(response.message ? response.message : 'Erro ao cadastrar usuário');
                $alert.modal('show');
           }
           $bt.removeClass('btn-spin');
       });
   });
   $("#tipo").on('change',function(){
      $('.alert-user').remove();
      if($(this).val() == 1){
          $('<div class="alert alert-danger alert-user animated shake">'+
                  '<p><i class="fa fa-exclamation-triangle"></i> ESTE USUÁRIO TERÁ ACESSO A TODAS AS FUNCIONALIDADES'+
                  ' DO SISTEMA!</p></div>').insertAfter($(this));
      }
   });
});
