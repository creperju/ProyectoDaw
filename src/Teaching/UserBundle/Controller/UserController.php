<?php

namespace Teaching\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Teaching\GeneralBundle\Entity\Messages;


class UserController extends Controller
{
    public function indexAction()
    {
        
        
        
        $user = $this->getUser();
        $url = $this->generateUrl("logout");
        $rol = $user->getRoles();
        
//        return new Response("<html><head><title>ENHORABUENA</title></head><body>"
//                . "Tipo de usuario: <h4>".$rol[0]."</h4>"
//                . "<b>Nombre de usuario: </b>".$user->getUsername()."<br/>"
//                . "<b>Email: </b>".$user->getEmail()."<br/>"
//                . "<b>Nombre: </b>".$user->getName()."<br/>"
//                . "<b>Apellidos: </b>".$user->getSurname().""
//                . "<p><a href='".$url."'>SALIR</a></body></html>");
//	
        
        
        return $this->render(
            'TeachingUserBundle::index.html.twig',
            array(
                'user' => $user->getUsername(),
            )
        );
        
        
    }
    
    
    
    public function messagesAction(Request $request)
    {
        
        $user = $this->getUser();
        
        $form = $this->createFormBuilder()
            ->add('Para', 'text')
            ->add('Asunto', 'text')
            ->add('Mensaje', 'textarea')
            ->add('Enviar', 'submit')
            ->getForm();
 
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $data = $form->getData();
            
            if( $data['Para'] != $user->getUsername()){
                // Grabo el mensaje
                $message = new Messages();
                
                $message->setFromUser($fromUser)
            }
            
        }
        
        
        return $this->render(
            'TeachingUserBundle::index.html.twig',
            array(
                'messages' => $messages,
                ''    => $form,
            )
        );
        
    }
    
    
    
    
}
