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
    text: "poco segura",
    color: "#D2322D",
    textColor: "#D2322D"
};
var normal = {
    x: 300,
    text: "normal",
    color: "#ffc40d",
    textColor: "#ffc40d"
};
var secure = {
    x: 400,
    text: "segura",
    color: "#30A7D7",
    textColor: "#30A7D7"
};
var toosecure = {
    x: 500,
    text: "muy segura",
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
    $("#NewPassword").keydown(function(e) {
        if (e.keyCode == 8) {
            if ($("#NewPassword").val().length == 1) {
                $("#grafico").hide(0);
            }
            state = valor;
            cadena = $("#NewPassword").val();
            ajustar();
            if (cadena.length >= 4) {
                if (pattminus.test(cadena)) {
                    if (minus) {
                        minus = false;
                        valor--;
                    }
                }
                if (pattmayus.test(cadena)) {
                    if (mayus) {
                        mayus = false;
                        valor--;
                    }
                }
                if (pattnumber.test(cadena)) {
                    if (numero) {
                        numero = false;
                        valor--;
                    }
                }
                if (pattspecial.test(cadena)) {
                    if (special) {
                        special = false;
                        valor--;
                    }
                }
            }
            else {
                valor = 0;
            }
//            if (state != valor) {
            animate(dimensiones[valor]);
//            }

        }
    });
    $("#NewPassword").keyup(function(e) {
        if ($("#NewPassword").val().length != 0) {
            $("#grafico").show(0);
        }
        state = valor;
        cadena = $("#NewPassword").val();
        ajustar();
        if (cadena.length >= 4) {
            if (pattminus.test(cadena)) {
                if (!minus) {
                    minus = true;
                    valor++;
                }
            }
            if (pattmayus.test(cadena)) {
                if (!mayus) {
                    mayus = true;
                    valor++;
                }
            }
            if (pattnumber.test(cadena)) {
                if (!numero) {
                    numero = true;
                    valor++;
                }
            }
            if (pattspecial.test(cadena)) {
                if (!special) {
                    special = true;
                    valor++;
                }
            }
        }
        else {
            valor = 0;
        }
//        if (state != valor) {
        animate(dimensiones[valor]);
//        }
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