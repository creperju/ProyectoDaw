<?php

namespace Teaching\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Teaching\GeneralBundle\Entity\Messages;
use Datetime;

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
                $to = $this->search($data['Para']);
                
                if($to != null){
                    // Grabo el mensaje
                    $message = new Messages();

                    $message->setFromUser($this->search($user->getUsername()));
                    $message->setToUser($this->search($data['Para']));
                    $message->setSubject($data['Asunto']);
                    $message->setMessage($data['Mensaje']);
                    $message->setDate(new \Datetime());

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($message);
                    $em->flush();

                    $msg_flash = 'Mensaje enviado.';
                }
                else{ $msg_flash = 'El usuario no existe.'; }
                
            }
            else{ $msg_flash = 'No puedes enviarte tú mismo un mensaje.'; }
            
            
            // Flash message
            $this->get('session')->getFlashBag()->add('message_send', $msg_flash);

            return $this->redirect($this->generateUrl('teaching_user_messages'));

            
        }
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Messages');
        
        $messages_send = $em->findBy(array('fromUser' => $user->getId()));
        $messages_receibe = $em->findBy(array('toUser' => $user->getId()));
        //echo "<pre>";print_r($messages);echo "</pre>";exit(0);
        if( ! count($messages_send) ) $messages_send = 'No hay mensajessss';
        if( ! count($messages_receibe) ) $messages_receibe = 'No hay mensajessss';
        
        return $this->render(
            'TeachingUserBundle::messages.html.twig',
            array(
                'controller' => 'Mensajes',
                'messages_send' => $messages_send,
                'messages_receibe' => $messages_receibe,
                'form'    => $form->createView(),
            )
        );
        
    }
    
    
    private function search($user)
    {
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Users');
        
        $result = $em->findOneBy(array('username' => $user));
        
        
        return $result;
    }
    
}
