
$('.table-list').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "ajax": "produto/",
    "lengthMenu": [[20, 10, 15, 25, 50,100, -1], [20, 10, 15, 25, 50,100, 'Tudo']],
    pageLength: 20,
    "columnDefs": [{"targets": [5,7,8], "orderable": false},{ "sClass": "text-center", "aTargets": [0,4,5,6,7] }],
    "language": {
        "url": "json/datatables-Portuguese-Brasil.json"
    },
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        if(!aData[3]){
            $('td:eq(3)', nRow).html('<button class="btn btn-default btn-xs btn-edit-cat" data-id="'+aData[0]+'"><i class="fa fa-plus"></i> Adicionar</button>');
        }
        if(aData[4]) {
            var $promo = $('<span class="label label-success" data-toggle="tooltip" title="Expira em '+aData[4]+' ">Promoção</span>');
            $promo.tooltip();
            $('td:eq(4)', nRow).html($promo);
        }
        if(aData[5] > 0) {
            var $disp = $('<span class="label label-success" data-toggle="tooltip" title="Produto Disponível - Quantidade em estoque: '+aData[5]+' "><i class="fa fa-thumbs-up"></i></span>');
            $disp.tooltip();
            $('td:eq(5)', nRow).html($disp);
        } else {
            var $ind = $('<span class="label label-danger" data-toggle="tooltip" title="Produto Indisponível"><i class="fa fa-thumbs-down"></i></span>');
            $ind.tooltip();
            $('td:eq(5)', nRow).html($ind);
        }
        if(aData[7]){
            $('td:eq(7)', nRow).html('<a href="#" class="btn-add-img-i" data-toggle="modal" data-target="#modal-add-img" data-id="'+aData[0]+'">'+aData[7]+'</a>');
        }
        var $btnGroup = $('<div class="btn-group btn-actions"></div>');
        var $btnEdit = $('<a href="produto/form/'+aData[8]+'" class="btn btn-default btn-xs" title="Editar"><i class="fa fa-pencil"></i></a>');
        var $btnDel = $('<a href="#" class="btn btn-default btn-xs btn-del" title="Excluir"><i class="fa fa-trash-o"></i></a>').data('produto',aData[8]);
        $btnGroup.html($btnEdit);
        $btnGroup.append($btnDel);
        $('td:eq(8)', nRow).html($btnGroup);
        return nRow;
    }
});

$(document).on('click','.btn-del',function (e) {
    e.preventDefault();
    if (!confirm('Tem certeza que deseja excluir este registro?'))
        return false;
    var id = $(this).data('produto');
    var $bt = $(this);
    $.ajax({
        url: 'produto/del/' + id,
        beforeSend: function () {
            $bt.addClass('btn-spin').children('i').hide();
        }
    }).done(function (response) {
        var $alert = $("#modal-alert");
        try {
            response = JSON.parse(response);
            if (response.success) {
                $alert.removeClass('moda-error').addClass('modal-success');
                $alert.find('.modal-body p').html(response.message);
                $alert.modal('show');
                var $tr = $bt.closest('tr');
                $tr.addClass('animated fadeOutLeft');
                setTimeout(function () {
                    $tr.remove();
                }, 1000);
            } else {

            }
        } catch (e) {
            $alert.removeClass('moda-success').addClass('modal-error');
            $alert.find('.modal-body p').html('Ocorreu um erro ao excluir o cliente!');
            $alert.modal('show');
        }
        $bt.removeClass('btn-spin').children('i').show();
    });
});
$(document).on('click','.btn-edit-cat',function (e) {
    e.preventDefault();
    var $td = $(this).parent();
    var prod = $(this).data('id');
    var $btnGroup = $('<div class="btn-group"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selecione<span class="caret"></span></button></div>');
    var $ul = $('<ul class="dropdown-menu" style="max-height:250px; overflow-y:auto;"></ul>');
    $.ajax({
        url : "categoria/get/",
        beforeSend: function (){
            $td.find('i').removeClass().addClass('fa fa-spin fa-spinner');
        }
    }).done(function(data){
        try{
            data = JSON.parse(data);
            $.each( data, function( key, val ) {
                $ul.append('<li><a class="cat-prod" href="javascript:void(0)"' +
                'data-value="'+val.id_categoria+'" data-prod="'+prod+'">'
                +val.no_categoria+'</a></li>');
            });
            $btnGroup.append($ul);
            $td.html($btnGroup);
        } catch (e){
            alert('Erro ao buscar categorias, recarregue a página e tente novamente');
        }
    });
    
});
$(document).on('click','.cat-prod',function (e) {
    e.preventDefault();
    var $li = $(this);
    var prod = $li.data('prod');
    var cat = $li.data('value');
    $.ajax({
        url : 'produto/categoria/'+prod+'/'+cat
    }).done(function(response){
        try{
            response = JSON.parse(response);
            if(response.success){
                $li.parents('td').html($li.text());
            } else {
                alert('Erro ao editar categoria');
            }
        } catch (e){
            console.log(e);
        }
    });
});

$(document).on('click','.btn-add-img-i',function (e) {
    e.preventDefault();
    $("#id-produto").val($(this).data('id'));
});