$(document).ready(function(){
   $('.gridmin li a').on('click',function(e){
       e.preventDefault();
       var $img = $(this).children('img').clone();
       $('.img-block img').addClass('animated fadeOut');
       setTimeout(function(){
           $('.img-block').html($img);
       },500);
       
   });
});

