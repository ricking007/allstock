(function(){
 $.ajax({
        url: 'notification/get/1'
    }).done(function (response) {
        try {
            response = JSON.parse(response);
            var $notMenu = $('.notifications-menu');
            $notMenu.find('.icon-animated-bell').attr('data-notifications', response.length);
            $notMenu.find('span.label-danger').text(response.length);
            var msg = 'Você tem ' + response.length + (response.length == 1 ? ' Notificação' : ' Notificações');
            $notMenu.find('.total-notifications').text(msg);
            var $ul = $notMenu.find('ul.menu');
            $ul.html('');
            $.each(response, function () {
                $ul.append('<li><a href="notification/read/' + this.id_notificacao + '"><i class="fa fa-envelope-o danger"></i>' +
                        this.dc_titulo + '</a></li>');
            });
        } catch (e) {

        }
    });
})(jQuery);

