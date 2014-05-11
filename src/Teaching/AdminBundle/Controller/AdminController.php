<?php

namespace Teaching\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $url = $this->generateUrl("logout");
        $rol = $user->getRoles();
        
        // User <> Group <> Course to get Course 
        $course = $user->getCourseTutor()->getCourse()->getCourse();
        $letter = $user->getCourseTutor()->getLetter();
        
        
//        echo "<pre>";print_r($courses);echo "</pre>";exit(0);
        
        return new Response("<html><head><title>ENHORABUENA</title></head><body>"
                . "Tipo de usuario: <h4>".$rol[0]."</h4>"
                . "<b>Nombre de usuario: </b>".$user->getUsername()."<br/>"
                . "<b>Email: </b>".$user->getEmail()."<br/>"
                . "<b>Nombre: </b>".$user->getName()."<br/>"
                . "<b>Apellidos: </b>".$user->getSurname().""
                . "<p><a href='".$url."'>SALIR</a>"
                . "<p>Es tutor de:<br/>Curso: ".$course." Grupo: ".$letter."</p>"
                . "</body></html>");
	
        
    }
    
    
    
    
}
