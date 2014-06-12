
// Show and hidden flash message
$(document).ready(function() {
    $('#msg_flash').delay(2000).fadeOut('slow');
    altura = $(window).height();
    $("#subcontenido").css("min-height", $(window).height() - 250);
    altura = $("imagen-cargar").height() / 2;
    $("#imagen-cargar").animate({
        marginTop: +altura
    }, 1500, function() {
        $('#contenido').slideDown('3000');
        $('#imagen-cargar').slideUp('3000');
    });
    $("a").click(function(e) {
        if ($(this).attr("class") != "no-animation" && $(this).attr("href") != "#") {
            e.preventDefault();
            var to = $(this).attr("href");
            $("#contenido").slideUp("3000");
            alto = $("#imagen-precargar").height();
            $("#imagen-precargar").slideDown("3000", function() {
                $("body").css("background-image", "none");
                $("#imagen-precargar").animate({
                    marginTop: -alto
                }, 1500, function() {
                    window.location.assign(to);
                });
            });
        }
    });
});



function smoothScroll(id_element, less) {
    var target = $("#" + id_element);
    $('html, body').stop().animate({
        scrollTop: (target.offset().top) - less
    }, 750);
}