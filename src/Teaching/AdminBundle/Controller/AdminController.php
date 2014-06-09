<?php

namespace Teaching\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Teaching\GeneralBundle\Entity\Messages;
use Teaching\GeneralBundle\Entity\Affilations;
use Datetime;


class AdminController extends Controller
{

    /**
     * Home of user with ROLE_ADMIN
     * 
     * @return type
     */
    public function indexAction()
    {
        
        $item = array(
            '0' => array(
                'name' => 'Asignaciones',
                'color' => 'white',
                'background' => '#30A7D7',
                'dimension' => '12',
                'offset' => '0',
                'oxs' => '1',
                'dxs' => '10',
                'link' => 'asignaciones'
            )
        );

        
        return $this->render(
            'TeachingAdminBundle::index.html.twig',
            array(
                'item' => $item
            )
        );
        
    }
    
    

    public function affilationsAction(Request $request)
    {
        
        // Messages receibe to this user
        $messages = $this->getMessages();

	// Get message id with send in 'Comprobar'
        $message_id = isset($_POST['id'])?$_POST['id']:'0';


	// Check if message exist with this id and user is current user
        if( $this->checkMessage($message_id, $messages) ){

	    // Get dni in message
            $dni = $this->getDni($message_id);
	    
	    // Return count of all enrollments with this dni
            $enrollments = $this->getEnrollment($dni);

	    
	    // If there is a match...
            if( count($enrollments) > 1 ){
		
		$span = count($enrollments['0']);
		
                $next = true;
		$show = true;
            }
            else{
                $back = true;
		$show = true;
            }

	    
	    
	    // Redirect the response
            $this->redirect($this->generateUrl('teaching_admin_affilations'));
        }
        



        return $this->render(
            'TeachingAdminBundle::affilations.html.twig',
            array(
                'messages' => $messages,
                'id'       => $message_id,
                'next'     => isset($next)? $next: false,
                'back'     => isset($back)? $back: false,
		'span'	   => isset($span)? $span: 0,
		'show'	   => isset($show)? $show: false
            )
        );

    }







    private function getMessages($id = null)
    {

        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Messages');
        
        if( $id )
            return $em->findBy(
                array(
                    'id'        => $id,
                    'toUser'    => $this->getUser()->getId()
                )
            );            
        else
            return $em->findBy(array('toUser' => $this->getUser()->getId()));
                
    }
    



    private function checkMessage($id, $messages)
    {

        for( $i=0; $i < count($messages); $i++ ){
            if( $id == $messages[$i]->getId() )
                return true;
        }

        return false;
    }




    private function getDni($message_id)
    {

        $message = $this->getMessages($message_id);

        $dni = $message[0]->getMessage();
        
        return explode("Dni: ", $dni);
    }

    
    
    
    /**
     * Get username of the message
     * 
     * @param type $message_id
     * @return type
     */
    private function getUsername($message_id)
    {

        $message = $this->getMessages($message_id);
	
	if( $message )
	    return $message[0]->getFromUser();
	else
	    return null;
	
	
    }



    
    
    private function getEnrollment($dni)
    {
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Enrollments');
        
	$datas = array();
        
        if( count($students = $em->findBy(array('dni_father' => $dni)) ) > 0 ){
	    
	    $datas['0'] = $students;   $datas['1'] = 'Padre';
	    
	    return $datas;
	}
	elseif( count($students = $em->findBy(array('dni_mother' => $dni)) ) > 0 ){
	    
	    $datas['0'] = $students;   $datas['1'] = 'Madre';
	    
	    return $datas;
	}
	elseif( count($students = $em->findBy(array('dni_tutor' => $dni)) ) > 0){
	    
	    $datas['0'] = $students;   $datas['1'] = 'Tutor';
	    
	    return $datas;
	}
        
        return '0';

    }


    
    
    public function asignAction(Request $request)
    {
	// Messages receibe to this user
        $messages = $this->getMessages();

	// Get message id with send in 'Comprobar'
        $message_id = isset($_POST['id'])?$_POST['id']:'0';


	// Check if message exist with this id and user is current user
        if( $this->checkMessage($message_id, $messages) ){

	    // Get dni in message
            $dni = $this->getDni($message_id);
	    
	    // Return count of all enrollments with this dni
            $enrollments = $this->getEnrollment($dni);

	    
	    // If there is a match...
            if( count($enrollments) > 1 ){
		
		$em = $this->getDoctrine()->getManager();
		
		$user = $this->getUsername($message_id);
		
		foreach($enrollments['0'] as $enrollment){
		    $student = $enrollment->getStudent();
		    
		    $class = new Affilations();
		    $class->setRelationship($enrollments['1']);
		    $class->setStudent($student);
		    $class->setUser($user);
		    $class->setMainResponsible(false);
		    
		    $em->persist($class);
		}
		
		$em->flush();
		
//		$message_to_user = new Messages();
//		
//		
//		$message_to_user->setFromUser($this->getUser());
//		$message_to_user->setToUser($user);
//		$message_to_user->setSubject('Éxito de asignación');
//		$message_to_user->setMessage('La asignación de alumnos se ha realizado correctamente. Gracias por usar Teaching!');
//		$message_to_user->setDate(new \Datetime());
//		
//		
//		$em->persist($message_to_user);
//			
//		$em->flush();
		
		$this->deleteMessage($message_id);
		
		// Flash message error
                $this->get('session')->getFlashBag()->add(
                    'msg',
                    'Se ha enviado un mensaje y se ha asignado correctamente.'
                );
		$this->get('session')->getFlashBag()->add(
                    'verificate',
                    'success'
                );
		
            }
            else{
		// Flash message error
                $this->get('session')->getFlashBag()->add(
                    'msg',
                    'No hay matrículas, inténtelo de nuevo.'
                );
		$this->get('session')->getFlashBag()->add(
                    'verificate',
                    'error'
                );
		
            }

	    
	    
	    
        }
	else{
	    // Flash message error
	    $this->get('session')->getFlashBag()->add(
		'msg',
		'El mensaje enviado no es válido. Inténtelo de nuevo.'
	    );
	    $this->get('session')->getFlashBag()->add(
		'verificate',
		'error'
	    );
	}
        

	
	
	
	
        // Redirect the response
	return $this->redirect($this->generateUrl('teaching_admin_affilations'));
	
	
    }
    
    
    public function moreInfoAction(Request $request)
    {
	// Messages receibe to this user
        $messages = $this->getMessages();

	// Get message id with send in 'Comprobar'
        $message_id = isset($_POST['id'])?$_POST['id']:'0';


	// Check if message exist with this id and user is current user
        if( $this->checkMessage($message_id, $messages) ){

	    // Get dni in message
            $dni = $this->getDni($message_id);
	    
	    // Return count of all enrollments with this dni
            $enrollments = $this->getEnrollment($dni);

	    
	    
	    // If there is a match...
            if( count($enrollments) < 2 ){
		
		$this->deleteMessage($message_id);
		
		
		// Flash message error
                $this->get('session')->getFlashBag()->add(
                    'msg',
                    'Se ha enviado un mensaje al usuario para pedir más información.'
                );
		$this->get('session')->getFlashBag()->add(
                    'verificate',
                    'success'
                );
	    }
	    else{
		
		// Flash message error
                $this->get('session')->getFlashBag()->add(
                    'msg',
                    'Este usuario tiene alumnos para ser asignados.'
                );
		$this->get('session')->getFlashBag()->add(
                    'verificate',
                    'error'
                );
		
		
	    }
	}
	else{
	    // Flash message error
	    $this->get('session')->getFlashBag()->add(
		'msg',
		'El mensaje no existe, inténtelo de nuevo.'
	    );
	    $this->get('session')->getFlashBag()->add(
		'verificate',
		'error'
	    );

	}

	 
	
	
        // Redirect the response
	return $this->redirect($this->generateUrl('teaching_admin_affilations'));
    }
    
    
    
    private function deleteMessage($id)
    {
	//echo "aquiii23";exit(0);
	$em = $this->getDoctrine()->getEntityManager();

	$message = $em->getRepository('TeachingGeneralBundle:Messages')->find($id);
	
	
	$em->remove($message);
	
	$em->flush();
	
    }
    
}
