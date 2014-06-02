
/****************************************/
/* Function to add black shadow an item */
/****************************************/



/* Add black shadow onmouseover */
function over(item)
{
    document.getElementById(item).className += " shadow-black";
}

/* Remove black shadow onmouseout */
function out(item)
{
    document.getElementById(item).className = document.getElementById(item).className.replace("shadow-black", "") ;
}
