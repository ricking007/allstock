$(document).ready(function(){
   $('.table-list tbody tr').dblclick(function(e){
      e.preventDefault();
      window.location.href = $('base').attr('href') + 'notification/read/'+$(this).data('notification');
   });
    $('.table-list').DataTable({
        responsive: true,
        "lengthMenu": [[20,10,15,25, 50, -1], [20,10,15,25, 50, 'Tudo']],
        pageLength : 20,
        "columnDefs": [ { "targets": 2, "orderable": false } ],
        "language": {
            "url": "json/datatables-Portuguese-Brasil.json"
        },
        "order": [[ 0, "desc" ]]
    });
});
