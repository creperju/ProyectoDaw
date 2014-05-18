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
    
    public function spanishAction()
    {
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Lengua');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Lengua',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
    }
    public function englishAction()
    {
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Inglés');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Inglés',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
    }
    public function musicAction()
    {
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Música');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Música',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
    }
    public function gymnasticsAction()
    {
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Gimnasia');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Gimnasia',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
    }
    public function natureAction()
    {
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Conocimiento del Medio');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Conocimiento del Medio',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
    }
    
    
    
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
    
    
    
    private function configAction(){}
    private function helpAction(){}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     public function mathsAction()
    {
        
        $student = $this->loadStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Matemáticas');
        else
            return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => 'Matemáticas',
                    'message' => 'No tiene asignado ningún alumno, contacte con el administrador.'
                )
            );
        
    }
    
    
    
    
    /**
     * Load students of user
     * 
     * @return type Return students of user
     */
    private function loadStudents()
    {
        // Get current user
        $user = $this->getUser()->getId();
        
        // Get students
        $students = $this->search($user, 'Affilations', 'user', true);
        
        return $students;
        
    }








    private function actionSubjects($students, $subject)
    {
        
        for($i = 0; $i < count($students); $i++){
            
            // Get student ID
            $student_id = $students[$i]->getStudent();
            
            $enrollment = $this->search($student_id, 'Enrollments', 'student');
            
            $group_id = $enrollment->getGroup();
            $subject_id = $this->search($subject, 'Subjects', 'name');
            
            $group_subject = $this->findGroupsSubjects($group_id, $subject_id);
            
            
            // Show activities
            $activities = $this->loadActivities($group_subject->getId());
            
            $activities_send[] = $this->loadActivitiesSend($student_id, $activities);
            
        }
        
        $menu = $this->loadMenu($subject);
        
//        foreach($activities_send as $activity => $id)
//            echo "<pre>";print_r($id->getActivity());echo "</pre>";
//        exit(0);
        
        return $this->render(
            'TeachingUserBundle::subjects.html.twig',
            array(
                'controller' => $subject,
		'menu' => $menu,
                'activities' => $activities_send
            )
        );
        
    }
    
    
    
    private function loadActivities($id)
    {
        
        $activities = $this->search($id, 'Activities', 'groupSubject', true);
        
        return $activities;
        
    }
    
    
    
    /**
     * Search result or results if $varius = true
     * 
     * @param type $data Data to find
     * @param type $entity Entity
     * @param type $field FindOneBy field
     * @return type Result
     */
    private function search($data, $entity, $field, $various = false)
    {
        // Find entity
	$em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:' . $entity);
        
	// Find data
        if( ! $various )
            $result = $em->findOneBy(array($field => $data));
        else
            $result = $em->findBy(array($field => $data));
        
        
	// Return data
        return $result;
    }
    
    
    
    private function findGroupsSubjects($group, $subject)
    {
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:GroupsSubjects');
        
        
        $id = $em->findOneBy(array(
                    'group'     => $group,
                    'subject'   => $subject
                ));
        
        
        return $id;
        
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
	    'Configuración' => '2', 
	    'Ayuda' => '1'
	);
	
	unset($content[$drop]);
	
	
	$i = 1;
	foreach($content as $element => $value){
	    
            if($i == 1){
                $menu = '<div class="col-sm-'.$value.' col-sm-offset-1 col-md-'.$value.' col-md-offset-1 col-lg-'.$value.' col-lg-offset-1"><center>'.$element.'</center></div>';
            
                $i++;
                continue;
            }
            
            $menu .= '<div class="col-sm-'.$value.' col-md-'.$value.' col-lg-'.$value.'"><center>'.$element.'</center></div>';
            
	}
	
	return $menu;
	
    }
    
    
    
    
    
    private function loadActivitiesSend($student, $activities)
    {
        
        foreach($activities as $activity){
            
            
            $query = $this->findStudentActivities($student, $activity->getId());
            
            $activities_send[] = $query;
            
        }
        
//        foreach($activities as $activity){
//            echo "<pre>";print_r($activity->getId());echo "</pre>";
//            
//        }
//        exit(0);
        
        
        
        return $activities_send;
        
    }
    
    
    
    
    
    private function findStudentActivities($student, $activity)
    {
        
        // Find entity
	$em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:ActivitiesStudents');
        
        
        $query = $em->findOneBy(array('student' => $student, 'activity' => $activity));
        
        
        return $query;
        
    }
    
    
    
}
