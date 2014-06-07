/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var datosServer;
$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault();
        var nombre = $(this).attr("name");
//        nombre += "as";
        var title = $("#" + nombre + "Title");
        var load = $("#" + nombre + "Load");
        var loading = $("#" + nombre + "Loading");
        var succes = $("#" + nombre + "Succes");
        var fail = $("#"+nombre+"Error");
        if(validaciones(nombre)){
            carga(loading);
            title.slideUp("500");
            succes.slideUp("500");
            fail.slideUp("500");
            load.slideDown("500", function(){
                var datos = $(this).serialize();

                $.ajax({
                    url: nombre+"/" ,
                    method: "post",
                    dataType: "json",
                    data: datos,
                    success: function (datosServer){                    
                        setTimeout(function () {success(datosServer, load, succes, fail)}, 3000);
                    },
                    error: function (){
                        error(load,succes, fail);
                    }
                });

            });
        }
        else{
           fail.html("Los campos señalados no son válidos");
           load.slideUp("slow");            
           succes.slideUp("slow"); 
           fail.slideDown("slow"); 
        }

    });
});

function error(load, succes,  fail) { //este método se ejecuta cuando no se puede establecer conexión al servidor
   $("#change").slideUp("slow");
   $("#error").slideDown("slow");
}
function success(datosServer, load, succes, fail) { //Este método se ejecuta cuando se establezca conexión al servidor
//    alert(datosServer.ok);
    if(datosServer.estado == "success"){ // cuando se procese correctamente la peticion al servidor y se ejecuten las modificaciones
        load.slideUp("slow");            
        fail.slideUp("slow");
        succes.slideDown("slow");
    }
    else { // cuando NO se procese correctamente la peticion al servidor y NO se ejecuten las modificaciones
        fail.html("<p><h3>"+datosServer.msg+"</h3></p>");
        load.slideUp("slow");            
        succes.slideUp("slow");
        fail.slideDown("slow");
        
    }
//    clearInterval(cargando);
//    puntos = 0;
//    loading.html("");

}
function carga(loading){
        loading.html("");
        setTimeout(function (){loading.html(".")},1000);
        setTimeout(function (){loading.html("..")},2000);
        setTimeout(function (){loading.html("...")},3000);
}

function validaciones (nombre){
    return true;
}