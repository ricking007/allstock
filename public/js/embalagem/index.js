   $('.btn-del').click(function(e){
       e.preventDefault();
       if(!confirm('Tem certeza que deseja excluir este registro?')) return false;
       var id = $(this).data('embalagem');
       var $bt = $(this);
       $.ajax({
           url : 'embalagem/del/'+id,
           beforeSend: function () {
               $bt.addClass('btn-spin').children('i').hide();
           }
       }).done(function(response){
           var $alert = $("#modal-alert");
           try{
               response = JSON.parse(response);
                if(response.success){
                    $alert.removeClass('moda-error').addClass('modal-success');
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                    var $tr = $bt.closest('tr');
                    $tr.addClass('animated fadeOutLeft');
                    setTimeout(function(){
                        $tr.remove();
                    },1000);
                } else {
                    
                }
           } catch (e){
               $alert.removeClass('moda-success').addClass('modal-error');
               $alert.find('.modal-body p').html('Ocorreu um erro ao excluir a embalagem!');
               $alert.modal('show');
           }
           $bt.removeClass('btn-spin').children('i').show();
       });
   });
   $('.table-list').DataTable({
        responsive: true,
        "lengthMenu": [[20,10,15,25, 50, -1], [20,10,15,25, 50, 'Tudo']],
        pageLength : 20,
        "columnDefs": [ { "targets": 2, "orderable": false } ],
        "language": {
            "url": "json/datatables-Portuguese-Brasil.json"
        }
    });