/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var datosServer;
var puntos =0;
var cargando;
$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault();
        var nombre = $(this).attr("name");
        var title = $("#" + nombre + "Title");
        var load = $("#" + nombre + "Load");
        var loading = $("#" + nombre + "Loading");
        var succes = $("#" + nombre + "Succes");
        var cargando = setInterval(function (){carga(loading);}, 1000);
        title.slideUp("slow");
        succes.slideUp("slow");
        load.slideDown("slow", function(){
            var datos = $(this).serialize();

            $.ajax({
                url: nombre+"/" ,
                method: "post",
                dataType: "json",
                data: datos,
                success: success(datosServer, load, succes),
                error: error()

            });
            
            
        });

    });
});

function error() {
    alert("Fallo");
}
function success(datosServer, load, succes) {
    load.slideUp("slow");            
    succes.slideDown("slow");
    

}
function carga(loading){
    puntos ++;
    if (puntos ==4){
        loading.html("");
        puntos=0;
    }
    else{
        actual = loading.html();
        actual += ".";
        loading.html(actual);
        
    }
}
