/*********************
 ******VARIABLES****** 
 *********************/
var minus = false;
var mayus = false;
var numero = false;
var special = false;
var sign = 1;
var valor = 0;
var animacion;
var vuelta = 0;
var speed = 5;
pattminus = /[a-z]/;
pattmayus = /[A-Z]/;
pattnumber = /[0-9]/;
pattspecial = /\W/;
var tooshort = {
    x: 100,
    text: "Demasiado corta",
    color: "#e1e1e1",
    textColor: "#e1e1e1"
};
var notsecure = {
    x: 200,
    text: "Poco segura",
    color: "#D2322D",
    textColor: "#D2322D"
};
var normal = {
    x: 300,
    text: "Normal",
    color: "#ffc40d",
    textColor: "#ffc40d"
};
var secure = {
    x: 400,
    text: "Segura",
    color: "#30A7D7",
    textColor: "#30A7D7"
};
var toosecure = {
    x: 500,
    text: "Muy segura",
    color: "#46A546",
    textColor: "#46A546"
};
var dimensiones = [tooshort, notsecure, normal, secure, toosecure];




/**************************
 *****EVENT LISTENERS****** 
 **************************/
$(document).ready(function() {
    ajustar();
    animate(dimensiones[0]);
    $("#NewPassword").keyup(function(e) {
        cadena = $("#NewPassword").val();
        if(cadena.length == 0){
            $("#grafico").hide(0);
        }
        else{
            $("#grafico").show(0);
        }
        state = valor;
        valor = 0;
        ajustar();
        minus = pattminus.test(cadena);
        mayus = pattmayus.test(cadena);
        numero = pattnumber.test(cadena);
        special = pattspecial.test(cadena);
        if (cadena.length >= 4) {
            if (minus)
                valor++;
            if (mayus)
                valor++;
            if (numero)
                valor++;
            if (special)
                valor++;

        }
        else {
            valor = 0;
            if(state == 0){
             animate(dimensiones[0])
            }
        }
        if (state != valor) {
            animate(dimensiones[valor]);
        }
    });

});


/********************************
 ***********FUNCTIONS************ 
 ********************************/


function animateLine(limitx, element, sign) {
    elemento = $("#" + element);
    var continuar = true;
    if (elemento.attr("width") != limitx) {
        vuelta++;
        nuevo = Number(elemento.attr("width")) + sign * speed;
//        document.getElementById("contador").innerHTML = nuevo + " ";
        TweenMax.to(elemento, 0, {attr: {'width': nuevo}});
    }

    else {
        continuar = false;
    }
    if (sign == 1) {
        if (elemento.attr("width") > limitx)
            continuar = false;
    }
    else {
        if (elemento.attr("width") < limitx)
            continuar = false;
    }

    if (!continuar) {
        clearInterval(animacion);

    }

}
function animate(object) {
    line = $("#Line");
    linegroup = $("#Linegroup");
    text = $("#texto");
    ajustar();
    $("#texto").html(object.text);
    if (object.x < line.attr("width")) {
        sign = -1;
    }
    else {
        sign = 1;
    }
    TweenMax.to(linegroup, 0.5, {css: {'fill': object.color}});
    TweenMax.to(text, 0.5, {css: {'fill': object.textColor}});
    clearInterval(animacion);
    animacion = setInterval(function() {
        animateLine(object.x, "Line", sign);
    }, 1);

}
function ajustar() {
    speed = Math.round(Number($("#svg").width()) / 200);
    for (i = 0; i < 5; i++) {
        dimensiones[i].x = Math.round((Number($("#svg").width()) / 5) * (i + 1));
    }
}