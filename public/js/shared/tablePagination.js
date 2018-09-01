(function ($) {
    "use strict";
    $.fn.tablePagination = function (options) {
        var $target = $(this);
        // Recebe opções pela inicialização
        var settings = $.extend({
                pageSize : 10,
                pagAlign : 'center',
                pageCurrent : 1,
                ajax : '',
                visiblePages : 5
        }, options);
        function pag(target,page){
            target.children('tbody').children('tr').hide();
            target.children('tbody').children('tr[data-page="'+page+'"]').show();
        }
        function load(){
           
            var $liActive = $('ul.pagination li.active');
            var page = $liActive.data('page');
            var offset = page * settings.pageSize - settings.pageSize;
            var data = 'ajax=1&offset='+offset;
            var $thOrder = $target.find('th.sort-active');
            if($thOrder.length){
               data += '&orderby='+$thOrder.data('sort');
               data += $thOrder.hasClass('desc') ? '&order=DESC' : '&order=ASC';
            }
            if(!$target.find('tbody tr[data-page="'+page+'"]:not(.tr-temp)').length){
                $.ajax({
                   url : settings.ajax,
                   method : 'post',
                   data : data,
                   beforeSend: function() {
                       $liActive.children('a').html('<i class="fa fa-spinner fa-spin"></i>');
                       alert('oi');
                   }
                }).done(function(data){
                    $target.find('tbody tr.tr-temp').remove();
                    $target.children('tbody').append(data);
                    $target.find('tr:not([data-page])').attr('data-page',page);
                    pag($target,page);
                    $liActive.children('a').html($liActive.data('page'));
                });
            } else {
               pag($target,page);
            }
        }
        if(!$("link[href*='tablePagination']").length){
            throw ('O css tablePagination nÃ£o foi carregado');
        }
        if (!$(this).is('table')) {
            throw ('O elemento alvo deve ser uma table');
        }
        $(this).addClass('table-pagination');
        
        //Verifica opções definidas por atributos
        if($(this).data('pagesize') !== undefined) settings.pageSize = $(this).data('pagesize');
        if($(this).data('visiblepages') !== undefined) settings.visiblePages = $(this).data('visiblepages');
        if($(this).data('pagalign') !== undefined) settings.pagAlign = $(this).data('pagalign');
        if($(this).data('pagecurrent') !== undefined) settings.pageCurrent = $(this).data('pagecurrent');
        if($(this).data('ajax') !== undefined) settings.ajax = $(this).data('ajax');
        
        var numItens = $(this).data('total');
        var numPages =  Math.ceil(numItens / settings.pageSize);
        var $nav = $('<nav class="text-'+settings.pagAlign+'"></nav>');
        
        var $ul = $('<ul class="pagination"></ul>');
        var $li = $('<li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
        $ul.html($li);
        for(var i = 1; i <= numPages ; i++){
            $li = $('<li data-page="'+i+'"><a href="#">'+i+'</a></li>');
            if(i > settings.visiblePages) $li.hide();
            if(i == settings.pageCurrent) $li.addClass('active');
            $ul.append($li);
        }
        var $li = $('<li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
        $ul.append($li);
        $nav.html($ul);
        
        $nav.insertAfter($target);
        var page = settings.pageCurrent;
        var dp = 0;
        $target.children('tbody').children('tr').each(function(){
           dp++;
           $(this).attr('data-page',page);
           if(dp >= settings.pageSize){
               dp = 0;
               page++;
           }
           $(this).data('page') == settings.pageCurrent && $(this).show();
        });
        if(numPages == 1){
            $nav.addClass('hidden');
        }
       
        $ul.children('li').children('a').on('click',function(e){
            e.preventDefault();
            var page = 0;
            if($(this).attr('aria-label') == "Previous"){
                page = $(this).parent().siblings('li.active').prev().data('page');
            } else if($(this).attr('aria-label') == "Next"){
                page = $(this).parent().siblings('li.active').next().data('page');
            } else {
                page = $(this).parent('li').data('page');    
            }
            if(page === undefined) return;
            
            $(this).parent('li').siblings().removeClass('active');
            var $liActive = $(this).parents('ul').children('li[data-page="'+page+'"]');
            $liActive.addClass('active');
            
            if(numPages > settings.visiblePages){
                var vis = 0;
                $liActive.prevAll('[data-page]').each(function(i){
                    if(i >= settings.visiblePages / 2) {
                        $(this).hide(); 
                    } else {
                        $(this).show();
                        vis++;
                    }
                });
                var visN = 0;
                $liActive.nextAll('[data-page]').each(function(i){
                    if(i < settings.visiblePages - vis - 1) {
                        $(this).show(); 
                        visN++;
                    } else {
                        $(this).hide();
                    }
                });
                
                if(vis + visN < settings.visiblePages - 1){
                     $liActive.prevAll('[data-page]').each(function(i){
                        if(i < settings.visiblePages - visN - 1) {
                            $(this).show(); 
                        } else {
                            $(this).hide();
                        }
                    });
                }
            }
            load();

        });
        $target.find('th[data-sort]').click(function(){
            $target.find('tbody tr').addClass('tr-temp');
            $(this).siblings().removeClass();
            if($(this).hasClass('asc')){
                $(this).removeClass('sort-active asc').addClass('sort-active desc');
            } else {
                $(this).removeClass('sort-active desc').addClass('sort-active asc');
            }
            load();
        });
        
    };
}(jQuery));
