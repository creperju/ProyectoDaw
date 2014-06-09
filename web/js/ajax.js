/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var datosServer;
$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        var nombre = $(this).attr("name");
//        nombre += "as";
        var title = $("#" + nombre + "Title");
        var load = $("#" + nombre + "Load");
        var loading = $("#" + nombre + "Loading");
        var succes = $("#" + nombre + "Succes");
        var fail = $("#"+nombre+"Error");
        var id = $(this).attr("id");
        smoothScroll(id, 200);
        if(validaciones(nombre)){
            carga(loading);
            title.slideUp("500");
            succes.slideUp("500");
            fail.slideUp("500");
            load.slideDown("500", function(){
                $.ajax({
                    url: nombre+"/" ,
                    method: "post",
                    dataType: "json",
                    data: datos,
                    success: function (datosServer){                    
                        setTimeout(function () {success(datosServer, load, succes, fail);}, 3000);
                    },
                    error: function (){
                        error(load,succes, fail);
                    }
                });

            });
        }
        else{
           title.slideDown("slow");
           load.slideUp("slow");            
           succes.slideUp("slow"); 
           fail.slideDown("slow"); 
        }

    });
});

function error(load, succes,  fail) { //este método se ejecuta cuando no se puede establecer conexión al servidor
   $("#change").slideUp("slow");
   $("#error").slideDown("slow");
   smoothScroll("header", 0);
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
        setTimeout(function (){loading.html(".");},1000);
        setTimeout(function (){loading.html("..");},2000);
        setTimeout(function (){loading.html("...");},3000);
}

function validaciones (nombre){
        if (nombre == "changeName"){
            return validarNombre(nombre);
        }
        
        if (nombre == "changeEmail"){
            return validarEmail(nombre);
        }
        
        if (nombre == "changePassword"){
            return validarPassword(nombre);
        }
}


function validarNombre (nombre){
    var fail = $("#"+nombre+"Error");
    fail.html("Campos incorrectos: ");
    labelname = $("#labelNewName");
    labelsurname = $("#labelNewSurname");
    valuename = $("#NewName").val();
    valuesurname = $("#NewSurname").val();
    validname= false;
    validsurname = false;
    if(valuename){
        var patt = /^\D{1,20}$/;
        var validname = patt.test(valuename);
    }
    else {
        validname = false;
    }
    if (valuesurname){
        var patt = /^\D{1,20}$/;
        var validsurname = patt.test(valuesurname);
    }
    else{
        validsurname = false;
    }
    
    if(validname){
        labelname.css("color", "#333");
    }else{
        fail.html(fail.html() + "Nombre ");
        labelname.css("color", "rgb(210, 50, 45)");
    }
    
    if(validsurname){
        labelsurname.css("color", "#333");
    }
    else{
        if(!validname){
            fail.html(fail.html() + "y ");
        }
        fail.html(fail.html()+ "Apellidos.");
        labelsurname.css("color", "rgb(210, 50, 45)");
    }
    
    if(validsurname && validname){
        return true;
    }
    else{
        return false;
    }
}


function validarEmail(nombre) {
    var fail = $("#"+nombre+"Error");
    labelemail = $("#labelNewEmail");
    valueemail = $("#NewEmail").val();
    validemail = false;
    if(valueemail){
        var patt = /^(\w)([.]*[_]*[-]*\w)+@([a-z])+([.]*[a-z])*[.]([a-z]{2,3})$/;
        validemail = patt.test(valueemail);
    }
    else {
        fail.html("El campo email no puede estar vacío si quiere cambiar su email");
        validemail = false;
    }
    
    if(validemail){
     
        labelemail.css("color", "#333");
         return true;
    }else{
        if (valueemail){
            fail.html("El email introducido no es válido");
        }
        labelemail.css("color", "rgb(210, 50, 45)");
        return false;
    }
    
    
  
}

function validarPassword(nombre) {
    var fail = $("#"+nombre+"Error");
    fail.html("Se encontraron los siguientes errores: <br/>");
    labelpassword= $("#labelPassword");
    labelnewpasswordOne = $("#labelNewPassword");
    labelnewpasswordTwo = $("#labelNewPassword2");
    valuepassword = $("#CurrentPassword").val();
    valuenewpasswordOne = $("#NewPassword").val();
    valuenewpasswordTwo = $("#NewPassword2").val();
    validpassword = false;
    validnewpasswordOne = false;
    validnewPasswordTwo = false;
    
    
    if(valuepassword){
       validpassword = true;
    }
    else {
        fail.html(fail.html()+"La contraseña no puede estar vacía <br/>");
        validpassword = false;
    }
    
    
    if (valuenewpasswordOne){
        if(valuepassword == valuenewpasswordOne){
            fail.html(fail.html()+ "La contraseña actual y la nueva no pueden coincidir <br/>");
            validnewpasswordOne = false;
        }
        else{
            var patt = /^\w{4,50}$/;
            validnewpasswordOne = patt.test(valuenewpasswordOne); 
            if (!validnewpasswordOne){
                fail.html(fail.html()+"La nueva contraseña debe tener entre 4 y 50 caracteres <br/>");
            }
        }
    }
    else{
        fail.html(fail.html()+"La nueva contraseña no puede estar vacía <br/>");
        validnewpasswordOne = false;
    }
    
    
    if (valuenewpasswordTwo){
        if (valuenewpasswordOne != valuenewpasswordTwo){
            fail.html(fail.html()+ "La nueva contraseña no coincide en los dos campos <br/>");
            validnewpasswordTwo = false;
        }
        else{
            validnewpasswordTwo = true;
        }
    }
    else{
        fail.html(fail.html()+"Debe repetir la nueva contraseña en el campo en que se indica <br/>");
        validnewpasswordTwo = false;
    }
    
    
    if (validpassword){
        labelpassword.css("color", "#333");
    }
    else{
        labelpassword.css("color", "rgb(210, 50, 45)");
    }
    
    
    if (validnewpasswordOne){
        labelnewpasswordOne.css("color", "#333");
    }
    else{
        labelnewpasswordOne.css("color", "rgb(210, 50, 45)");
    }
    
    if (validnewpasswordTwo){
        labelnewpasswordTwo.css("color", "#333");
    }
    else{
        labelnewpasswordTwo.css("color", "rgb(210, 50, 45)");
    }
    
    if(validpassword && validnewpasswordOne && validnewpasswordTwo){
        return true;
    }
    else{
        return false;
    }
}