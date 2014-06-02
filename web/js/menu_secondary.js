
/***************************************************************************/
/* Show and hidde differents divs in subjects or messages or configuration */
/***************************************************************************/

/* Change class on mouse over */
function menuOver(item)
{
    document.getElementById(item).className = document.getElementById(item).className.replace("actions", "select"); 
}

/* Change class on mouse out */
function menuOut(item)
{    
    document.getElementById(item).className = document.getElementById(item).className.replace("select", "actions");   
}

/* Hidde content and show the current view */
function menuShow(item)
{
    $('.contenido').hide();
    $('#'+item+'-mostrar').show();
}