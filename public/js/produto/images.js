$(function () {
    $('.btn-select-img').click(function() {
        $('.cropit-image-input').click();
        
    });
    $('.image-editor').cropit({
        smallImage : 'stretch',
        minZoom : 'fit',
        quality: .8,
        onImageLoaded : function(){
            var $img = $('.image-editor').cropit('imageSize');
            if($img.width < 450 || $img.height < 333){
                $('<div class="alert alert-info alert-img-sm">Sua imagem possui tamanho de '
                  +$img.width+'px de largura por '+$img.height+'px de altura. Procure utilizar imagens '+ 
                  'maiores ou iguais a 450px de largura por 333px de altura.</div>').insertBefore('.image-editor');
                setTimeout(function(){
                   $('.alert-img-sm').addClass('animated fadeOut');
                },8000);
                setTimeout(function(){
                   $('.alert-img-sm').remove();
                },9000);
            }
        }
    });
    $('#form-add-img').submit(function () {
        
        var $bt = $(this).find('.btn-action-ajax');
        
        // Move cropped image data to hidden input
        var imageData = $('.image-editor').cropit('export',{quality: .6});
        
        $('.hidden-image-data').val(imageData);

        // Print HTTP request params
        var formValue = $(this).serialize();
        $.ajax({
            url: 'produto/setimage/'+$("#id-produto").val(),
            method: 'post',
            data : 'imagem='+formValue,
            beforeSend: function () {
                $bt.addClass('btn-spin');
            }
        }).done(function(response){
            $bt.removeClass('btn-spin');
            try{
                response = JSON.parse(response);
                if(response.success){
                    var $li = $('<li></li>');
                    var $thumbnail = $('<div class="thumbnail"></div>');
                    var $img = $('<img src="img/produtos/'+response.id+'.jpg"/>');
                    var $caption = $('<div class="caption"></div>');
                    var $btCapa = $('<button type="button" class="btn btn-default btn-xs bt-capa-img" data-img="'+response.id+'.jpg"><i class="fa fa-picture-o"></i></button>&nbsp;');
                    var $btDel = $('<button type="button" class="btn btn-danger btn-xs bt-del-img" data-img="'+response.id+'.jpg"><i class="fa fa-trash"></i></button>');
                    $thumbnail.html($img);
                    $caption.html($btCapa).append($btDel);
                    $thumbnail.append($caption);
                    $li.html($thumbnail);
                    $li.insertBefore($('li.new'));
                    $('#form-add-img').get(0).reset();
                    $("#modal-add-img").modal('hide');
                    $('.cropit-image-preview').removeClass('cropit-image-loaded').removeAttr('style');
                    var $a = $('a.btn-add-img-i[data-id="'+$("#id-produto").val()+'"]');
                    var qtdF = parseInt($a.text());
                    $a.text(++qtdF);
                } else {
                    alert('Erro ao salvar imagem!');
                }
            } catch (e){
                alert('Erro ao salvar imagem!');
            }
        });

        // Prevent the form from actually submitting
        return false;
    });
});
$(document).on('click','.bt-del-img',function(){
   var img = $(this).data('img');
   var $target = $(this);
   
   $.ajax({
       url : 'produto/delimage/'+img,
        beforeSend: function () {
            $target.addClass('btn-spin');
        }
   }).done(function(response){
       try{
           response = JSON.parse(response);
           if(response.success){
               $target.parents('li').addClass('animated fadeOutUp');
                setTimeout(function(){
                    $target.parents('li').remove();
                },1000);
           }
       } catch (e){
           $target.removeClass('btn-spin');
           alert('Erro ao excluir imagem');
       }
   });
});
$(document).on('click','.bt-capa-img',function(){
   var img = $(this).data('img');
   var $target = $(this);
   
   $.ajax({
       url : 'produto/capa/'+img,
        beforeSend: function () {
            $target.addClass('btn-spin');
        }
   }).done(function(response){
       $target.removeClass('btn-spin');
       try{
           response = JSON.parse(response);
           if(response.success){
               $('.thumbnail').removeClass('active');
               $target.parents('.thumbnail').addClass('active');
           }
       } catch (e){
           alert('Erro ao definir imagem como capa');
       }
   });
});
