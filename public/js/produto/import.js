$('#form-import').on('submit',function(e){
    e.preventDefault();
    $("#report-import").removeClass('hidden');
    $('#progresso').text('0%').attr('aria-valuenow', 0).css('width', '0');
    var file = $("#arquivo")[0].files[0];

    var reader = new FileReader();
    reader.onload = function(progressEvent){

        // By lines
        var lines = this.result.split('\n');
        //console.log(lines.length);return;
        var i = 0;
        for(var line = 0; line < lines.length; line++){
            
            (function (index) {
                  $.ajax({
                    url: 'produto/setline/',
                    method: 'post',
                    data: 'line=' + lines[line]
                    }).done(function (response) {
                        i++;
                        var porcentagem = i * 100 / lines.length;
                        $('#progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');
                        response = JSON.parse(response);
                        var $tr = $('<tr></tr>');
                        var $td = '<td>' + (lines[index].split(';').join('</td><td>')) + '</td><td>'+response.msg +'</td>';
                        
                        //$tr.html('<td>'+lines[index]+'</td>').append('<td>'+response.msg+'</td>');
                        $tr.html($td);
                        if(response.success){
                            $tr.addClass('alert-success');
                        } else {
                            $tr.addClass('alert-danger');
                        }
                        $("#report-import").find('table tbody').append($tr);
                        
                    });
             })(line);
        }
        $("#report-import").find('table tbody tr:last-child').remove();
    };
    reader.readAsText(file);
    
});