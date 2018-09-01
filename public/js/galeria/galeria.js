$(document).ready(function(){
    $('#bt-add').click(function() {
        $('#imagem').click();
    }); 
  
    // Iniciando biblioteca
    var resize = new window.resize();
    resize.init();

    // Declarando variáveis
    var imagens;
    var imagem_atual;

    // Quando selecionado as imagens
    $('#imagem').on('change', function () {
        enviar();
    });


    /*
     Envia os arquivos selecionados
     */
    function enviar()
    {
        // Verificando se o navegador tem suporte aos recursos para redimensionamento
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
            alert('O navegador não suporta os recursos utilizados pelo aplicativo');
            return;
        }

        // Alocando imagens selecionadas
        imagens = $('#imagem')[0].files;

        // Se selecionado pelo menos uma imagem
        if (imagens.length > 0)
        {
            // Definindo progresso de carregamento
            $('#progresso').attr('aria-valuenow', 0).css('width', '0%');

            // Escondendo campo de imagem
            $('#imagem').hide();

            // Iniciando redimensionamento
            imagem_atual = 0;
            redimensionar();
        }
    }

    /*
     Redimensiona uma imagem e passa para a próxima recursivamente
     */
    function redimensionar()
    {
        // Se redimensionado todas as imagens
        if (imagem_atual > imagens.length)
        {
            // Definindo progresso de finalizado
            $('#progresso').html('Imagen(s) enviada(s) com sucesso');

            // Limpando imagens
            limpar();

            // Exibindo campo de imagem
            $('#imagem').show();

            // Finalizando
            return;
        }

        // Se não for um arquivo válido
        if ((typeof imagens[imagem_atual] !== 'object') || (imagens[imagem_atual] == null))
        {
            // Passa para a próxima imagem
            imagem_atual++;
            redimensionar();
            return;
        }

        // Redimensionando
        resize.photo(imagens[imagem_atual], 800, 'dataURL', function (imagem) {
            
            // Salvando imagem no servidor
            $.post('galeria/add/'+$("#form-fotos").data('album'), {imagem: imagem}, function(response) {

                // Definindo porcentagem
                var porcentagem = (imagem_atual + 1) / imagens.length * 100;

                // Atualizando barra de progresso
                $('#progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');

                // Aplica delay de 1 segundo
                // Apenas para evitar sobrecarga de requisições
                // e ficar visualmente melhor o progresso
                setTimeout(function () {
                    // Passa para a próxima imagem
                    imagem_atual++;
                    redimensionar();
                }, 1000);
                response = JSON.parse(response);
                if($('.thumbnail').length == 0) $("#fotos-galeria").html('');
                if(response.success){
                    $("#fotos-galeria").append('<div class="col-md-3 col-sm-6 animated fadeIn">'+
                            '<div class="thumbnail">'+
                                '<img src="img/albuns/'+$("#form-fotos").data('album')+'/thumb/'+response.id+'.jpg" />'+
                                '<div class="caption text-center"><button type="button" class="btn btn-default btn-xs bt-capa-img" data-img="'+response.id+'.jpg">'+
                                '    <i class="fa fa-picture-o"></i>'+
                                '</button>&nbsp;'+
                                '<button type="button" class="btn btn-danger btn-xs bt-del-img" data-img="'+response.id+'.jpg">'+
                                '    <i class="fa fa-trash"></i>'+
                                '</button></div>'+
                                '</div></div>');
                }
            });

        });
    }

    /*
     Limpa os arquivos selecionados
     */
    function limpar()
    {
        var input = $("#imagem");
        input.replaceWith(input.val('').clone(true));
    }
    $('.gal-title').on('blur keyup',function(e){
       if(e.keyCode == 13 || e.keyCode == undefined){
            //alert($(this).val());
            $.post('galeria/titulo/'+$("#form-fotos").data('album'), {title: $(this).val()}, function() {});
       }    
    });
});
$(document).on('click','.bt-del-img',function(){
   var img = $(this).data('img');
   var $target = $(this);
   
   $.ajax({
       url : 'galeria/delimage/'+img+'/'+$("#form-fotos").data('album'),
        beforeSend: function () {
            $target.addClass('btn-spin');
        }
   }).done(function(response){
       try{
           response = JSON.parse(response);
           if(response.success){
               $target.parents('.thumbnail').parent('div').addClass('animated fadeOutLeft');
                setTimeout(function(){
                    $target.parents('.thumbnail').parent('div').remove();
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
       url : 'galeria/capa/'+img,
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


