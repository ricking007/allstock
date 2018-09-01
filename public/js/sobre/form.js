$(document).ready(function(){
   $("#sobre").summernote({height:250,lang:'pt-BR'});
   $("#form-sobre").on('submit',function(e){
       e.preventDefault();
       var data = $(this).serialize();
       var $form = $(this);
       var $bt = $(this).find('.btn-action-ajax');
       $.ajax({
           url : 'sobre/edit/',
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
                    if(!$("#id-marca").length){ 
                        $form.get(0).reset();
                        $("#nome").focus();
                    }
                    $alert.removeClass('modal-error').addClass('modal-success');
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                } else {
                    $alert.removeClass('modal-success').addClass('modal-error');
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                }
           } catch (e){
                $alert.removeClass('modal-success').addClass('modal-error');
                $alert.find('.modal-body p').html('Ocorreu um erro ao salvar o texto!');
                $alert.modal('show');
           }
           $bt.removeClass('btn-spin');
       });
   });
});