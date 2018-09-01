$(document).ready(function(){
   $('#show-more').click(function(){
      var url = $('.list-group-item.active').length ? $('.list-group-item.active').attr('href') : 'produtos';
      $.ajax({
         url : url,
         method : 'post',
         data : 'ajax=1&offset='+$('#produtos-container .wrapper').length,
            beforeSend: function (xhr) {
                $("#show-more").removeClass('btn-action-ajax');
            }
      }).done(function(response){
          $("#show-more").addClass('btn-action-ajax');
          $('#produtos-container').append(response);
          if(response == '' || $('#produtos-container').data('total') <= $('#produtos-container .wrapper').length) $("#show-more").remove();
      });
   });
});