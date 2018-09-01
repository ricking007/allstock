$('.choose-avatar li').click(function(){
       var img = $(this).children('img').data('img');
       $(this).siblings().removeClass('active');
       $(this).addClass('active');
       $.ajax({
          url : 'perfil/setImg/'+img
       }).done(function(response){
           try{
               response = JSON.parse(response);
               if(response.success){
                   $('.img-perfil').attr('src','img/'+img);
               } else {
                   alert('Erro ao trocar o tema');
               }
           }catch (e){
               console.log(e);
               alert('Erro ao trocar o tema');
           }
       });
});
$('.change-pass').click(function(e){
   e.preventDefault();
   $("#form-change-pass").addClass('animated fadeIn').removeClass('hidden');
});
$("#form-change-pass").on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var $bt = $(this).find('.btn-action-ajax');
    $.ajax({
       url : 'perfil/password/',
       data : data,
       method : 'post',
       beforeSend: function () {
            $bt.addClass('btn-spin');
            $('.form-group').removeClass('has-error');
            $('small.error,span.error').remove();
       }
    }).done(function(response){
        
           try {
                response = JSON.parse(response);
                if(response.success){
                   $('.ajax-response').addClass('has-success').html('<span class="success">'+response.message+'</span>');
                   $("#form-change-pass").get(0).reset();
                } else {
                    $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                    });
                    $('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
           } catch (e){
                console.log(e);
           }
           $bt.removeClass('btn-spin');
    });
});