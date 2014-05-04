<?php

namespace Teaching\TeacherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class TeacherController extends Controller
{
    public function indexAction()
    {
        
        
        $user = $this->getUser();
        $url = $this->generateUrl("logout");
        $rol = $user->getRoles();
        
        return new Response("<html><head><title>ENHORABUENA</title></head><body>"
                . "Tipo de usuario: <h4>".$rol[0]."</h4>"
                . "<b>Nombre de usuario: </b>".$user->getUsername()."<br/>"
                . "<b>Email: </b>".$user->getEmail()."<br/>"
                . "<b>Nombre: </b>".$user->getName()."<br/>"
                . "<b>Apellidos: </b>".$user->getSurname().""
                . "<p><a href='".$url."'>SALIR</a></body></html>");
	
        
        
        
    }
}
