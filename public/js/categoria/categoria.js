$(document).ready(function(){
    $('#form-categoria').on('submit',function(e){
       e.preventDefault();
       var data = $(this).serialize();
       var $form = $(this);
       var $bt = $(this).find('.btn-action-ajax');
       $.ajax({
           url : 'categoria/add/',
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
                    if(!$("#id-categoria").length){ 
                        $form.get(0).reset();
                        $("#nome").focus();
                    }
                    $alert.removeClass('modal-error').addClass('modal-success');
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                } else {
                     $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                     });
                     $('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
           } catch (e){
                $alert.removeClass('modal-success').addClass('modal-error');
                $alert.find('.modal-body p').html('Ocorreu um erro ao cadastrar categoria!');
                $alert.modal('show');
           }
           $bt.removeClass('btn-spin');
       });
   });
});
