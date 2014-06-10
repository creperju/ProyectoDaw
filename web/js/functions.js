
// Show and hidden flash message
$(document).ready(function(){
  $('#msg_flash').delay(2000).fadeOut('slow');
  setTimeout(function (){
      $('#contenido').slideDown('3000');
      $('#imagen-cargar').slideUp('3000');
  }, 1000)
  $("a").click(function (e){
      e.preventDefault();
      var to = $(this).attr("href");
      $("#contenido").slideUp("3000");
      alto = $("#imagen-precargar").height();
      $("#imagen-precargar").slideDown("3000", function (){
          $("#imagen-precargar").animate({
              marginTop: -alto
          }, 1500, function (){
             window.location.assign(to); 
          });
      });
  });
});



function smoothScroll(id_element, less){
    var target = $("#"+id_element);
    $('html, body').stop().animate({
        scrollTop: (target.offset().top) - less
    }, 750);
}