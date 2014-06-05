/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault();
        var nombre = $(this).attr("name");
        var title = $("#" + nombre + "Title");
        var load = $("#" + nombre + "Load");
        var loading = $("#" + nombre + "Loading");
        var succes = $("#" + nombre + "Succes");
        title.slideUp("slow");
        load.slideDown("slow");
        var datos = $(this).serialize();
       
        $.ajax({
            url: "/usuario/configuracion/"+nombre+"/" ,
            method: "post",
            dataType: "json",
            data: datos,
            success: function (datosServer) {
                $("#changePasswordLoad").slideUp("slow");            
                $("#changePasswordSucces").slideDown("slow");
            },
            error: error()

        });

    });
});

function error() {
    alert("Fallo");
}
function success(datosServer) {

}
