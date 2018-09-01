$(document).ready(function(){
    function contarLista(){
        $.ajax({
           url: 'lista/contar',
           type: 'get'
           
        }).success(function(data) {
            data = JSON.parse(data);
            $('.qt-lista').text(data.qt)
                    .data('qt',data.qt)
                    .attr('data-qt',data.qt);
        }); 
    }
    contarLista();
});