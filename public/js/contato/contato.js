function initialize() {
  var myLatlng = new google.maps.LatLng(-12.920870, -38.460724);
  var mapOptions = {
    zoom: 17,
    scrollwheel: false,
    //navigationControl: false,
    //mapTypeControl: false,
    //scaleControl: false,
    //draggable: false,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  
  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'JS Atacado',
      center : -50
  });
  var infowindow = new google.maps.InfoWindow();
  infowindow.setContent('<strong>JS Atacado</strong><br/>Av. Cardeal Avelar Brandão Villela, 2696 - Jardim Santo Inacio<br/>Salvador - BA');
  google.maps.event.addListener(marker, 'click', function() {
    map.setCenter(marker.getPosition());
  });
  infowindow.open(map,marker);
}

function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize&signed_in=true&language=pt";
  document.body.appendChild(script);
}

window.onload = loadScript;

$(document).ready(function(){
    $('#form-contato').on('submit',function(e){
        e.preventDefault();
        var $form = $(this);
        var data = $form.serialize();
        var $icon = $form.find('.btn-action-ajax i');
        $.ajax({
           url : 'contato/send/',
           method: 'post',
           data : data,
           beforeSend: function () {
                $icon.show();
                $('.form-group').removeClass('has-error');
                $('.form-group').removeClass('has-success');
                $('small.error,span.error,span.success,small.success').remove();
           }
        }).done(function(response){
            $icon.hide();
            try{
                response = JSON.parse(response);
                if(response.success){
                    $form.get(0).reset();
                    $form.find('.ajax-response').addClass('has-success').html('<span class="success">'+response.message+'</span>');
                } else {
                    $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                     });
                     $form.find('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
            } catch (e){
                $form.find('.ajax-response').addClass('has-error').html('<span class="error">Ocorreu um erro ao enviar mensagem!</span>');
            }

        });
    });
    
    $('#form-curriculum').on('submit',function(e){
        e.preventDefault();
        var $form = $(this);
        var formData = new FormData();
        var data = $form.serializeArray();
        var $icon = $form.find('.btn-action-ajax i');
        $.each(data, function(e, d) {
            formData.append(d.name, d.value)
        });
        formData.append("arquivo", $("#arquivo")[0].files[0]);
        $.ajax({
           url : 'contato/curriculum/',
           method: 'post',
           data : formData,
           cache: false,
           contentType: false,
           processData: false,
           beforeSend: function () {
                $icon.show();
                $('.form-group').removeClass('has-error');
                $('.form-group').removeClass('has-success');
                $('small.error,span.error,span.success,small.success').remove();
           }
        }).done(function(response){
            $icon.hide();
            try{
                response = JSON.parse(response);
                if(response.success){
                    $form.get(0).reset();
                    $form.find('.ajax-response').addClass('has-success').html('<span class="success">'+response.message+'</span>');
                } else {
                    $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                     });
                     $form.find('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
            } catch (e){
                $form.find('.ajax-response').addClass('has-error').html('<span class="error">Ocorreu um erro ao enviar mensagem!</span>');
            }

        });
    });
});
    

