$(document).ready(function(){
    $("#descricao").summernote({height:100,lang:'pt-BR'});
    $('input[name="valor"],input[name="venda"]').maskMoney({decimal:",", thousands:"."});
    $('input[name="cod"]').focus();
    $('#form-produto').on('submit',function(e){
       e.preventDefault();
       var data = $(this).serialize();
       var $form = $(this);
       var $bt = $(this).find('.btn-action-ajax');
       $.ajax({
           url : 'produto/add/',
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
                    $("#id-produto").val(response.id);
                    $(".thumbs").removeClass('hidden');
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
                $alert.find('.modal-body p').html('Ocorreu um erro ao cadastrar produto!');
                $alert.modal('show');
           }
           $bt.removeClass('btn-spin');
       });
   });
   
   $('.dyn-add').click(function(){
      var target = $(this).data('add');
      $('#modal-add-opt').find('.modal-title').text('Adicionar '+ target);
      $('#btn-save-opt').data('target',target).attr('data-target',target);
   });
   
   $('#btn-save-opt').click(function(){
            var $bt = $(this);
            var target = $bt.data('target');
            $.ajax({
               url : target + '/add/',
               method : 'post',
               data : 'nome='+$('#opt-add').val(),
               beforeSend: function(){
                   $bt.addClass('btn-spin');
                   $('#modal-add-opt').find('.form-group').removeClass('has-error');
                   $('#modal-add-opt').find('small.error,span.error').remove();
               }
            }).done(function(response){
                  $bt.removeClass('btn-spin');
                  try{
                      response = JSON.parse(response);
                      if(response.success){
                          $('#modal-add-opt').modal('hide');
                          $('select#'+target).append('<option value="'+response.id+'" selected>'+$('#opt-add').val()+'</option>');
                          $('#opt-add').val('');
                      } else {
                           $.each(response.errors,function(){
                               var $field = $('#opt-add');
                               $field.closest('.form-group').addClass('has-error');
                               $('<small class="error">'+this.message+'</small>').insertAfter($field);
                           });
                      }
                  } catch (e){
                      alert('Erro ao cadastrar '+target);
                  }
            });
      });
      $("#promo").on('change',function(){
        if($(this).prop('checked')){
            $(".pc-desc, .vl-venda").addClass('fadeInUp').removeClass('hidden fadeOutUp');
            $(".dt-exp").removeClass('hidden');
        } else {
            $(".pc-desc, .vl-venda").removeClass('fadeInUp').addClass('fadeOutUp');
            $('input[name="nm_porcentagem"]').val(0);
            $('.vl-venda h4 span').text($('input[name="valor"]').val());
            $(".dt-exp").addClass('hidden');
        }
      });
      $('input[name="valor"],input[name="nm_porcentagem"],input[name="promocao"],#qt_emb,#embalagem').on('change blur keyup click',function(){
          var valor = $('input[name="valor"]').val().replace(',','.');
          var pc = $('input[name="nm_porcentagem"]').val();
          var qtd = $('input[name="qt_emb"]').val();
          valor = parseFloat(valor);
          pc = parseInt(pc);
          qtd = parseInt(qtd);
          var venda = 0.00;
          if(!isNaN(pc)){
            venda = (valor - (valor * pc / 100)).toFixed(2);
          } else {
            venda = valor.toFixed(2);
          }
          var vl_unid = (Math.floor((venda / qtd)*100)/100).toFixed(2);
          if(isNaN(vl_unid)) { vl_unid = '-'; }
          if(isNaN(venda)){
             $('.vl-venda h4 span').text($('input[name="valor"]').val());
             $('.info-valor-unit span').text($('input[name="valor"]').val());
          } else {
             $('.vl-venda h4 span').text(venda.replace('.',','));
             $('.info-valor-unit span').text(vl_unid.replace('.',','));
          }
          
      });
});
$(function () {
    $('#expira').datetimepicker({
        stepping : 60,
        icons : {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar-o',
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            previous: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            today: 'fa fa-bullseye',
            clear: 'fa fa-trash-o',
            close: 'fa fa-times'
        },
        locale : 'pt-br',
        widgetPositioning : {
            horizontal: 'right',
            vertical: 'bottom'
        }
    });
  
});