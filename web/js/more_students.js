

function open_button(){
    
    $('#open_button').addClass('open');
    //document.getElementById('open_button').className += ' open';
    
}

function choose_student(id, name){
    
    // Add text in button select
    $('#button_students').html(name + '&nbsp;&nbsp;<span class="caret"></span>');
    $('#open_button').removeClass('open');
    
    // Hidde all students
    $('.student').removeClass('active').addClass('contenido');
    
    // Show student id
    $('#'+id).removeClass('contenido').addClass('active');
    
    //document.getElementById('open_button').className = document.getElementById('open_button').className.replace('open','');
    
    //document.getElementById('student').className = document.getElementById('student').className.replace('active',' contenido');
    
    //document.getElementById(id).className = document.getElementById('open_button').className.replace('contenido','active');
}
