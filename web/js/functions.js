
// Show and hidden flash message
$(document).ready(function(){
  $('#msg_flash').delay(2000).fadeOut('slow');
  
});



function smoothScroll(id_element, less){
    var target = $("#"+id_element);
    $('html, body').stop().animate({
        scrollTop: (target.offset().top) - less
    }, 750);
}