$(document).ready(function(){
   $('#form-xml').submit(function(e){
       var $form = $(this);
       e.preventDefault();
       var data = new FormData();
       var serial = $(this).serializeArray();
       $.each(serial,function(key,input){
            data.append(input.name,input.value);
       });
       data.append('file',$('#file')[0].files[0]);
       var $bt = $form.find('.btn-action-ajax');
       $.ajax({
           url: "notification/send/",
           method : 'post',
           data : data,
           cache: false,
           contentType: false,
           processData: false,
           beforeSend: function() {
               $bt.addClass('btn-spin');
               $('.form-group').removeClass('has-error').removeClass('has-success');
               $('small.error,span.error').remove();
           }
        }).done(function(data) {
           $bt.removeClass('btn-spin');
           data = JSON.parse(data);
           
           if(data.success){
               $('#file').val('');
               setTimeout(function () {
                    $.getScript($('base').attr('href')+"js/shared/notification.js", function () {
                    });
                }, 2000);
               $('.ajax-response').addClass('has-success').html('<span class="success">'+data.message+'</span>');
           } else {
               if(data.errors){
                    $.each(data.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                    });
                    $('.ajax-response').addClass('has-error').html('<span class="error">'+data.message+'</span>');
                }
                $('.ajax-response').addClass('has-error').html('<span class="error">'+data.message+'</span>');
           }
           
        });
   });
});
