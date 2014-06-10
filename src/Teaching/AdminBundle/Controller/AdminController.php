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
    
    
    
    /**
     * Show all request of users that sign up in teaching and not assing students
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
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






    /**
     * Get messages of current user admin
     * 
     * @param type $id
     * @return type
     */
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
    



    /**
     * Check if message exist
     * 
     * @param type $id
     * @param type $messages
     * @return boolean
     */
    private function checkMessage($id, $messages)
    {

        for( $i=0; $i < count($messages); $i++ ){
            if( $id == $messages[$i]->getId() )
                return true;
        }

        return false;
    }



    
    /**
     * Get dni from message
     * 
     * @param type $message_id
     * @return type
     */
    private function getDni($message_id)
    {
	// Find message
        $message = $this->getMessages($message_id);
	
	// Get content message
        $dni = $message[0]->getMessage();
        
	// Return dni
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
	// Get message
        $message = $this->getMessages($message_id);
	
	// If not exists message return null, unless return user
	if( $message )
	    return $message[0]->getFromUser();
	else
	    return null;
	
    }



    
    /**
     * Return all enrollments that match with dni from user
     * 
     * @param type $dni
     * @return string
     */
    private function getEnrollment($dni)
    {
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Enrollments');
        
	// Array with [0] => students | [1] => father, mother or tutor
	$datas = array();
        
	// Return array with information, unless, return 0
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


    
    /**
     * Assign students to user
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
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
		
		// Get user from message
		$user = $this->getUsername($message_id);
		
		$this->findStudentsInEnrollments($enrollments, $user);
		
		// Subject and message to user
		$subject = 'Éxito de asignación';
		$message = 'La asignación de alumnos se ha realizado correctamente. Gracias por usar Teaching!';
		
		// Write new message to user
		$this->writeMessage($user, $subject, $message);
		
		// Delete message
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
    
    
    
    /**
     * User not found in table enrollments, delete message and send message to user
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
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
		
		// Get user from message
		$user = $this->getUsername($message_id);
		
		// Subject and message to user
		$subject = 'Error asignación';
		$message = 'La asignación de alumnos no se ha realizado correctamente. Vuelva a escribir sus datos personales por favor.';
		
		// Write new message to user
		$this->writeMessage($user, $subject, $message);
		
		// Delete his message
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
                    'Este usuario ya tiene alumnos asignados.'
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
    
    
    
    /**
     * Delete messages
     * 
     * @param type $id
     */
    private function deleteMessage($id)
    {
	$em = $this->getDoctrine()->getManager();
	$message = $em->getRepository('TeachingGeneralBundle:Messages')->find($id);
	
	// Get message and delete
	$em->remove($message);
	
	$em->flush();
	
    }
    
    
    /**
     * Find students in enrollments and add user <> student in affilation
     * 
     * @param type $enrollments
     * @param type $user
     */
    private function findStudentsInEnrollments($enrollments, $user)
    {
	
	$em = $this->getDoctrine()->getManager();
		
	
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
	
    }
 
    
    
    private function writeMessage($user, $subject, $message)
    {
	
	
	// Edit message to user
	$message_to_user = new Messages();

	$message_to_user->setFromUser($this->getUser());
	$message_to_user->setToUser($user);
	$message_to_user->setSubject($subject);
	$message_to_user->setMessage($message);
	$message_to_user->setDate(new \Datetime());


	// Send new message
	$em = $this->getDoctrine()->getManager();
	$em->persist($message_to_user);
	$em->flush();
	
    }
    
    
}
