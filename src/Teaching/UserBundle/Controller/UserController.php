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
        
        
//        return new Response("<html><head><title>ENHORABUENA</title></head><body>"
//                . "Tipo de usuario: <h4>".$rol[0]."</h4>"
//                . "<b>Nombre de usuario: </b>".$user->getUsername()."<br/>"
//                . "<b>Email: </b>".$user->getEmail()."<br/>"
//                . "<b>Nombre: </b>".$user->getName()."<br/>"
//                . "<b>Apellidos: </b>".$user->getSurname().""
//                . "<p><a href='".$url."'>SALIR</a></body></html>");
//	
        
	$menu = array(
	    '0' => array(
		'name' => 'Matemáticas',
		'color' => 'white',
		'background' => 'gold',
		'dimension' => '4',
		'link' => 'matematicas'
	    ),
	    '1' => array(
		'name' => 'Lengua',
		'color' => 'white',
		'background' => 'blue',
		'dimension' => '4',
		'link' => 'lengua'
	    ),
	    '2' => array(
		'name' => 'Inglés',
		'color' => 'white',
		'background' => 'red',
		'dimension' => '4',
		'link' => 'ingles'
	    ),
	    '3' => array(
		'name' => 'Música',
		'color' => 'white',
		'background' => 'purple',
		'dimension' => '4',
		'link' => 'musica'
	    ),
	    '4' => array(
		'name' => 'Gimnasia',
		'color' => 'white',
		'background' => 'orange',
		'dimension' => '4',
		'link' => 'gimnasia'
	    ),
	    '5' => array(
		'name' => 'Conocimiento del Medio',
		'color' => 'white',
		'background' => 'green',
		'dimension' => '4',
		'link' => 'conocimientodelmedio'
	    ),
	    '6' => array(
		'name' => 'Mensajes',
		'color' => 'white',
		'background' => 'blue',
		'dimension' => '3',
		'link' => 'mensajes'
	    ),
	    '7' => array(
		'name' => 'Configuración',
		'color' => 'white',
		'background' => 'gray',
		'dimension' => '3',
		'link' => 'configuracion'
	    ),
	    '8' => array(
		'name' => 'Ayuda',
		'color' => 'black',
		'background' => 'white',
		'dimension' => '6',
		'link' => 'ayuda'
	    ),
	);
	
	
	
        return $this->render(
            'TeachingGeneralBundle:Login:menu.html.twig',
            array(
		'menu' => $menu
            )
        );
        
        
    }
    
    
    
    private function mathsAction(){}
    private function spanishAction(){}
    private function englishAction(){}
    private function musicAction(){}
    private function gymnasticsAction(){}
    private function natureAction(){}
    private function configAction(){}
    private function helpAction(){}
    
    
    
    /**
     * Controller to view, send messages.
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
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
                $to = $this->search($data['Para'], 'Users', 'username');
                
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
	
	$menu = $this->loadMenu('Mensajes');
        
        return $this->render(
            'TeachingUserBundle::messages.html.twig',
            array(
                'controller' => 'Mensajes',
		'menu' => $menu,
                'messages_send' => $messages_send,
                'messages_receibe' => $messages_receibe,
                'form'    => $form->createView(),
            )
        );
        
    }
    
    
    
    /**
     * Search one result.
     * 
     * @param type $data Data to find
     * @param type $entity Entity
     * @param type $field FindOneBy field
     * @return type Result
     */
    private function search($data, $entity, $field)
    {
        // Find entity
	$em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:' . $entity);
        
	// Find data
        $result = $em->findOneBy(array($field => $data));
        
	// Return data
        return $result;
    }
    
    
    
    /**
     * Load a dynamic menu
     * 
     * @param type $drop This controller not view in menu
     * @return string Html code to insert in twig
     */
    private function loadMenu($drop)
    {
	$content = array(
	    'Matemáticas' => '1', 
	    'Lengua' => '1', 
	    'Inglés' => '1', 
	    'Música' => '1', 
	    'Gimnasia' => '1', 
	    'Conocimiento del Medio' => '2', 
	    'Mensajes' => '1', 
	    'Configuración' => '1', 
	    'Ayuda' => '1'
	);
	
	unset($content[$drop]);
	
	//$menu = '<div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1">k</div>';
	
	$menu = '';
	
	foreach($content as $element => $value){
	    
	    $menu .= '<div class="col-sm-'.$value.' col-md-'.$value.' col-lg-'.$value.'"><center>'.$element.'</center></div>';
	    
	}
	
	return $menu;
	
    }
    
    
}
