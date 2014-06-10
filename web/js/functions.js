
// Show and hidden flash message
$(document).ready(function(){
  $('#msg_flash').delay(2000).fadeOut('slow');
  setTimeout(function (){
      $('#contenido').slideDown('3000');
      $('#imagen-cargar').slideUp('3000');
  }, 1000)
//  $()
});



function smoothScroll(id_element, less){
    var target = $("#"+id_element);
    $('html, body').stop().animate({
        scrollTop: (target.offset().top) - less
    }, 750);
}