function initialize() {
  var myLatlng = new google.maps.LatLng(-22.824857,-47.188158);
  var mapOptions = {
    zoom: 15,
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
      title: 'Doces Puro Sabor'
  });
  var infowindow = new google.maps.InfoWindow();
  infowindow.setContent('<b><b>');
  google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
  });
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
                    $('.ajax-response').addClass('has-success').html('<span class="success">'+response.message+'</span>');
                } else {
                    $.each(response.errors,function(){
                         var $field = $('#'+this.field);
                         $field.closest('.form-group').addClass('has-error');
                         $('<small class="error">'+this.message+'</small>').insertAfter($field);
                     });
                     $('.ajax-response').addClass('has-error').html('<span class="error">'+response.message+'</span>');
                }
            } catch (e){

            }

        });
    });
    $('.btn-details').click(function(e){
        e.preventDefault();
        var url = $(this).data('href');
        $.ajax({
           url : url,
           beforeSend: function () {
            $('#modal-detalhes .modal-dialog .modal-content').
                    html('<p class="loading"><i class="fa fa-spinner fa-spin"></i> Carregando...</p>');
           }
        }).done(function(response){
            $('#modal-detalhes .modal-dialog .modal-content').html(response);
        });
    });
});
