
/***************************************************************************/
/* Show and hidde differents divs in subjects or messages or configuration */
/***************************************************************************/

/* Show list of a students */
function open_button()
{    
    // Add class 'open' in button
    $('#open_button').addClass('open');   
}

/* Choose student to show activities of this student */
function choose_student(id, name)
{
    // Add text in button select with name of student
    $('#button_students').html(name + '&nbsp;&nbsp;<span class="caret"></span>');
    $('#open_button').removeClass('open');
    
    // Hide all students    
    $('.student').hide();
    
    // Show activities of student
    $('[id*='+id+']').show();
}
