$(function () {
    
    $('.btn-select-img').click(function() {
        $('.cropit-image-input').click();
    });
    $('.image-editor').cropit({
        smallImage : 'stretch',
        minZoom : 'fit',
        quality: .7,
        onImageLoaded : function(){
            var $img = $('.image-editor').cropit('imageSize');
            if($img.width < 1177 || $img.height < 525){
               alert('Para melhor visualização no site, procure colocar uma '+
                    'imagem com tamanho mínimo de 1177px de largura por 525px de altura');
            }
        }
    });

    $('#form-add-img').submit(function () {
        
        var $bt = $(this).find('.btn-action-ajax');
        
        // Move cropped image data to hidden input
        var imageData = $('.image-editor').cropit('export',{quality: .8});
        
        $('.hidden-image-data').val(imageData);

        // Print HTTP request params
        var formValue = $(this).serialize();
        $.ajax({
            url: 'carousel/add/',
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
                    window.location.href=$('base').attr('href') + 'carousel';
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
    $('.btn-del-img').on('click', function () {
        if(!confirm('Tem certeza que deseja excluir este registro?')) return false;
        var img = $(this).data('img');
        var $target = $(this);

        $.ajax({
            url: 'carousel/del/' + img,
            beforeSend: function () {
                $target.addClass('btn-spin');
            }
        }).done(function (response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    /*$target.parents('li').addClass('animated fadeOutUp');
                    setTimeout(function () {
                        $target.parents('li').remove();
                    }, 1000);*/
                    window.location.href=$('base').attr('href') + 'carousel';
                }
            } catch (e) {
                $target.removeClass('btn-spin');
                alert('Erro ao excluir imagem');
            }
        });
    });
    $('.btn-edit-caption').on('click',function(){
       var id = $(this).data('caption');
       $.ajax({
          url : 'carousel/getconfig/'+id 
       }).done(function(response){
           try{
               response = JSON.parse(response);
               $("#id_carousel_edit").val(response.id_carousel);
               $("#caption").val(response.dc_caption);
               $("#link").val(response.dc_link);
           } catch(e){
               alert('Erro ao recuperar configurações');
           }
           $("#caption").summernote({height:100,lang:'pt-BR'});
       });
    });
});

