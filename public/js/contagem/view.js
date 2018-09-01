$('.table-list').DataTable({
        responsive: true,
        "lengthMenu": [[20,10,15,25, 50, -1], [20,10,15,25, 50, 'Tudo']],
        pageLength : 20,
        "columnDefs": [ { "targets": 2, "orderable": false } ],
        "language": {
            "url": "json/datatables-Portuguese-Brasil.json"
        }
    });