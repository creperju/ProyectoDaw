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
	    )
        );
          
        
        $message = array(
            '0' => array(
                'name' => 'Mensajes',
                'color' => 'white',
                'background' => 'blue',
                'dimension' => '3',
                'link' => 'mensajes',
                'intro_s' => '2',
                'intro_m' => 'Aquí podrás ver, enviar o recibir mensajes.',
                'intro_p' => 'right'
            )
        );
	    
        $config = array(
            '0' => array(
                'name' => 'Configuración',
                'color' => 'white',
                'background' => 'gray',
                'dimension' => '3',
                'link' => 'configuracion',
                'intro_s' => '3',
                'intro_m' => 'Aquí podrás cambiar tu contraseña o tu correo.',
                'intro_p' => 'left'
            )
        );
	    
//	    ),
//	    '8' => array(
//		'name' => 'Ayuda',
//		'color' => 'black',
//		'background' => 'white',
//		'dimension' => '6',
//		'link' => 'ayuda'
//	    ),
//	);
	
	
	
        return $this->render(
            'TeachingGeneralBundle:Login:menu.html.twig',
            array(
		'subjects' => $menu,
                'message' => $message,
                'config' => $config
            )
        );
        
        
    }
    
    public function spanishAction()
    {
       
        $student = $this->findStudents();
        
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
        
        $student = $this->findStudents();
        
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
        
        
        $student = $this->findStudents();
        
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
        
        $student = $this->findStudents();
        
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
        $student = $this->findStudents();
        
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

                    $message->setFromUser($this->search($user->getUsername(), 'Users', 'username'));
                    $message->setToUser($this->search($data['Para'], 'Users', 'username'));
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
	
	//$menu = $this->loadMenu('Mensajes');
        
        return $this->render(
            'TeachingUserBundle::messages.html.twig',
            array(
                'controller' => 'Mensajes',
		//'menu' => $menu,
                'messages_send' => $messages_send,
                'messages_receibe' => $messages_receibe,
                'form'    => $form->createView(),
            )
        );
        
    }
    
    
    
    private function configAction(){}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     * SENTENCIA SQL PARA MIRAR SI UN ALUMNO HA HECHO LAS TAREAS!!
     * 
     *	select
     *	     ac.activity_name
     *	    ,s.name
     *	    ,acs.state
	from users u 
	    right join affilations af on u.id = af.user_id
	    right join students s on af.student_id = s.id
	    right join activities_students acs on s.id = acs.student_id
	    right join activities ac on acs.activity_id = ac.id
	    right join groups_subjects gs on ac.groupSubject_id = gs.id
	    right join subjects sub on gs.subject_id = sub.id
	where s.id = 1
	;
     * 
     * 
     * 
     */
    
    
    
     public function mathsAction()
    {
        
        $student = $this->findStudents();
        
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
    private function findStudents()
    {
        // Get current user
        $user = $this->getUser()->getId();
        
	
	$users = "TeachingGeneralBundle:Users";
	$affilations = "TeachingGeneralBundle:Affilations";
	$students = "TeachingGeneralBundle:Students";
	
	
	$em = $this->getDoctrine()->getManager();
	
	
	// Query 
	$query = $em->createQuery("
		SELECT s		      
		FROM $users u
		    JOIN $affilations af with u.id = af.user
		    JOIN $students s with af.student = s.id
		WHERE u.id = $user
	");
	
	
	
	
//        // Get students
//        $students = $this->search($user, 'Affilations', 'user', true);
//        
//	echo "<pre>";print_r($students);echo "</pre>";exit(0);
//	
//        return $students;
        
	
	return $query->getResult();
	
    }








    private function actionSubjects($students, $subject)
    {
	
	$student_id = $students[0]->getId();
	$subject_id = $this->search($subject, 'Subjects', "name")->getId();
	
//        echo "Student id: " . $student_id;
//        echo "<br/>";
//        echo "Subject id " . $subject_id;
//        exit(0);
        
        $activities = $this->getActivitiesStudentsToHave($student_id, $subject_id);
	$activities_send = $this->getActivitiesStudentsSend($student_id, $subject_id);
        $activities_pending = $this->getActivitiesStudentsPending($student_id, $subject_id);
        
        
//        echo "<pre>";
//        if(count($activities))
//            echo print_r($activities);
//        else
//            echo "No hay actividades";
//        echo "</pre>";exit(0);
        
        //$menu = $this->loadMenu($subject);
        
        return $this->render(
            'TeachingUserBundle::subjects.html.twig',
            array(
                'controller' => $subject,
		//'menu' => $menu,
                'activities' => $activities,
                'activities_send' => $activities_send,
                'activities_pending' => $activities_pending
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
    
    
    
    
    /**
     * Load view from students and activities that they have to do.
     * 
     * @param type $student_id Student id
     * @param type $subject_id Subject id
     * @return type Query
     */
    private function getActivitiesStudentsToHave($student_id, $subject_id)
    {
	// Entities required
	$users = "TeachingGeneralBundle:Users";
	$affilations = "TeachingGeneralBundle:Affilations";
	$students = "TeachingGeneralBundle:Students";
	$activities_students = "TeachingGeneralBundle:ActivitiesStudents";
	$activities = "TeachingGeneralBundle:Activities";
	$groups_subjects = "TeachingGeneralBundle:GroupsSubjects";
	$subjects = "TeachingGeneralBundle:Subjects";
	
	
	$em = $this->getDoctrine()->getManager();
	
	
	// Query 
	$query = $em->createQuery("
		SELECT 
		      ac.activityName
		    , ac.type
		    , ac.dateStart
		    , ac.dateEnd
		    , s.name
		    , acs.state
		FROM $users u
		    JOIN $affilations af with u.id = af.user
		    JOIN $students s with af.student = s.id
		    JOIN $activities_students acs with s.id = acs.student
		    JOIN $activities ac with acs.activity = ac.id
		    JOIN $groups_subjects gs with ac.groupSubject = gs.id
		    JOIN $subjects  sub with gs.subject = sub.id
		WHERE s.id = $student_id and sub.id = $subject_id 
		 
	");
	
	
//	$result = $query->getResult();
//	print_r($result[0]);
//	exit(0);
	
	
	return $query->getResult();
	
    }
    
    private function getActivitiesStudentsSend($student_id, $subject_id)
    {
        // Entities required
	$users = "TeachingGeneralBundle:Users";
	$affilations = "TeachingGeneralBundle:Affilations";
	$students = "TeachingGeneralBundle:Students";
	$activities_students = "TeachingGeneralBundle:ActivitiesStudents";
	$activities = "TeachingGeneralBundle:Activities";
	$groups_subjects = "TeachingGeneralBundle:GroupsSubjects";
	$subjects = "TeachingGeneralBundle:Subjects";
	
	
	$em = $this->getDoctrine()->getManager();
	
	
	// Query 
	$query = $em->createQuery("
		SELECT 
		      ac.activityName
		    , ac.type
		    , acs.date
		    , acs.observations
		FROM $users u
		    JOIN $affilations af with u.id = af.user
		    JOIN $students s with af.student = s.id
		    JOIN $activities_students acs with s.id = acs.student
		    JOIN $activities ac with acs.activity = ac.id
		    JOIN $groups_subjects gs with ac.groupSubject = gs.id
		    JOIN $subjects  sub with gs.subject = sub.id
		WHERE s.id = $student_id and sub.id = $subject_id and acs.state is not null
		 
	");
	
	
//	$result = $query->getResult();
//	print_r($result[0]);
//	exit(0);
	
	
	return $query->getResult();
    }
    
    
    
    private function getActivitiesStudentsPending($student_id, $subject_id)
    {
        
        // Entities required
	$users = "TeachingGeneralBundle:Users";
	$affilations = "TeachingGeneralBundle:Affilations";
	$students = "TeachingGeneralBundle:Students";
	$activities_students = "TeachingGeneralBundle:ActivitiesStudents";
	$activities = "TeachingGeneralBundle:Activities";
	$groups_subjects = "TeachingGeneralBundle:GroupsSubjects";
	$subjects = "TeachingGeneralBundle:Subjects";
	
	
	$em = $this->getDoctrine()->getManager();
	
	
	// Query 
	$query = $em->createQuery("
		SELECT 
		      ac.activityName
		    , ac.type
		    , ac.description
		    , ac.dateStart
                    , ac.dateEnd
		FROM $users u
		    JOIN $affilations af with u.id = af.user
		    JOIN $students s with af.student = s.id
		    JOIN $activities_students acs with s.id = acs.student
		    JOIN $activities ac with acs.activity = ac.id
		    JOIN $groups_subjects gs with ac.groupSubject = gs.id
		    JOIN $subjects  sub with gs.subject = sub.id
		WHERE s.id = $student_id and sub.id = $subject_id and acs.state is null
		 
	");
	
	
//	$result = $query->getResult();
//	print_r($result[0]);
//	exit(0);
	
	
	return $query->getResult();
        
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
