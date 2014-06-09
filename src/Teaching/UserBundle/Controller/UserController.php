<?php

namespace Teaching\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Teaching\GeneralBundle\Entity\Messages;
use Datetime;

class UserController extends Controller
{
        
    /**
     * Home user
     * 
     * @return type
     */
    public function indexAction()
    {
        
        // Many arrays to show differents subjects and items, also can be customize
	
	$menu1 = array(
	    '0' => array(
		'name' => 'Lengua',
		'color' => 'white',
		'background' => '#005580',
		'dimension' => '5',
		'offset' => '0',
		'oxs' => '1',
		'dxs' => '4',
		'link' => 'lengua'
	    ),
	    '1' => array(
		'name' => 'Inglés',
		'color' => 'white',
		'background' => '#E3350D',
		'dimension' => '6',
		'offset' => '1',
		'oxs' => '2',
		'dxs' => '4',
		'link' => 'ingles'
	    )
	);

    

	$menu2 = array(
	    '0' => array(
		'name' => 'Música',
		'color' => 'white',
		'background' => '#7a43b6',
		'dimension' => '5',
		'offset' => '0',
		'oxs' => '1',
		'dxs' => '4',
		'link' => 'musica'
	    ),
	    '1' => array(
		'name' => 'Gimnasia',
		'color' => 'white',
		'background' => '#f89406',
		'dimension' => '6',
		'offset' => '1',
		'oxs' => '2',
		'dxs' => '4',
		'link' => 'gimnasia'
	    )
	);

	$menu3 = array(
	    '0' => array(
		'name' => 'Matemáticas',
		'color' => 'white',
		'background' => '#ffc40d',
		'dimension' => '12',
		'offset' => '0',
		'link' => 'matematicas'
	    )
	);


	$menu4 = array(
	    '0' => array(
		'name' => 'Conocimiento del Medio',
		'color' => 'white',
		'background' => '#46a546',
		'dimension' => '12',
		'offset' => '0',
		'link' => 'conocimientodelmedio'
	    )
	);


	$message = array(
	    '0' => array(
		'name' => 'Mensajes',
		'color' => 'white',
		'background' => '#30A7D7',
		'dimension' => '11',
		'offset' => '1',
		'link' => 'mensajes',
		'intro_s' => '2',
		'intro_m' => 'Aquí podrás ver tus mensajes recibidos, tus mensajes enviados y enviar mensajes a otros usuarios.',
		'intro_p' => 'top'
	    )
	);

	$config = array(
	    '0' => array(
		'name' => 'Configuración',
		'color' => 'white',
		'background' => '#333',
		'dimension' => '11',
		'offset' => '1',
		'link' => 'configuracion',
		'intro_s' => '3',
		'intro_m' => 'Aquí podrás cambiar tus datos personales, tales como tu nombre, correo electrónico o tu contraseña.',
		'intro_p' => 'top'
	    )
	);

        

        return $this->render(
            'TeachingGeneralBundle:Login:menu.html.twig',
            array(
                'subjects1' => $menu1,
                'subjects2' => $menu2,
                'subjects3' => $menu3,
                'subjects4' => $menu4,
                'message' => $message,
                'config' => $config
            )
        );
        
    }
    
    
    
    /**
     * View Spanish
     * @return type
     */
    public function spanishAction(Request $request)
    {
	// Return students assign into user
        $student = $this->findStudents();
        //echo "<pre>"; print_r($student); echo "</pre>"; exit(0);
        if(count($student))
            return $this->actionSubjects($student, 'Lengua');
        else
            return $this->contactStudentsAction($request, 'Lengua');
            
    }
    
    
    
    /**
     * View English
     * @return type
     */
    public function englishAction(Request $request)
    {
        // Return students assign into user
        $student = $this->findStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Inglés');
        else
            return $this->contactStudentsAction($request,'Inglés');
             
    }
    
    
    
    /**
     * View Music
     * 
     * @return type
     */
    public function musicAction(Request $request)
    {
        // Return students assign into user
        $student = $this->findStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Música');
        else
            return $this->contactStudentsAction($request, 'Música');
              
    }
    
    
    
    /**
     * View Gymnastics
     * @return type
     */
    public function gymnasticsAction(Request $request)
    {
        // Return students assign into user
        $student = $this->findStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Gimnasia');
        else
            return $this->contactStudentsAction($request, 'Gimnasia');

    }
    
    
    
    /**
     * View Maths
     * @return type
     */
    public function mathsAction(Request $request)
    {
        // Return students assign into user
        $student = $this->findStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Matemáticas');
        else
            return $this->contactStudentsAction($request, 'Matemáticas');
            
    }
    
    
    
    /**
     * View Nature
     * @return type
     */
    public function natureAction(Request $request)
    {
        // Return students assign into user
        $student = $this->findStudents();
        
        if(count($student))
            return $this->actionSubjects($student, 'Conocimiento del Medio', 'C. del Medio');
        else
            return $this->contactStudentsAction($request, 'Conocimiento del Medio', 'C. del Medio');
               
    }
    
    
    
    /**
     * View Messages
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function messagesAction(Request $request)
    {
        
        $user = $this->getUser();
        
	// Form to send message
        $form = $this->createFormBuilder()
            ->add('Para', 'text')
            ->add('Asunto', 'text')
            ->add('Mensaje', 'textarea')
            ->getForm();
 
        $form->handleRequest($request);

	
	// Only if user send a message
        if ($form->isValid()) {
            
	    // Get data of message
            $data = $form->getData();
            
	    // Not send message if user receibe is hisself
            if( $data['Para'] != $user->getUsername()){
		
		// Find user receibe message
                $to = $this->search($data['Para'], 'Users', 'username');
                
		// If there is a user with this username, entry
                if($to != null){
                    
                    if($to->getUsername() != 'admin'){
    		    // Create new class Messages
                        $message = new Messages();

    		    // Edit fields of message
                        $message->setFromUser($this->search($user->getUsername(), 'Users', 'username'));
                        $message->setToUser($to);
                        $message->setSubject($data['Asunto']);
                        $message->setMessage($data['Mensaje']);
                        $message->setDate(new \Datetime());

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($message);
                        
    		    $em->flush(); // Send message

                        $msg_flash = 'Mensaje enviado.';

                        $this->get('session')->getFlashBag()->add(
                            'verificate',
                            'success'
                        );
                    }
                    else{
                        $msg_flash = 'Este usuario no admite mensajes.'; 

                        $this->get('session')->getFlashBag()->add(
                            'verificate',
                            'error'
                        );
                    }
        
                }
                else
                { 
                    $msg_flash = 'El usuario no existe.'; 

                    $this->get('session')->getFlashBag()->add(
                        'verificate',
                        'error'
                    );
                }
            }  
            else
            { 
                $msg_flash = 'No puedes enviarte tú mismo un mensaje.'; 

                $this->get('session')->getFlashBag()->add(
                    'verificate',
                    'error'
                );
        
            }

            // Flash message
            $this->get('session')->getFlashBag()->add('message_send', $msg_flash);

            return $this->redirect($this->generateUrl('teaching_user_messages'));

        }
            
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Messages');
        
	// Get messages send and messages receibe
        $messages_send = $em->findBy(array('fromUser' => $user->getId()));
        $messages_receibe = $em->findBy(array('toUser' => $user->getId()));
	
        return $this->render(
            'TeachingUserBundle::messages.html.twig',
            array(
                'controller' => 'Mensajes',
                'messages_send' => $messages_send,
                'messages_receibe' => $messages_receibe,
                'form'    => $form->createView()
            )
        );
        
    }
    
    
        
    public function configAction(){
        $user = $this->getUser();
        return $this->render('TeachingUserBundle::config.html.twig', 
                array(
                    "controller" => "Configuración",
                    "Usuario" => $user->getUserName()
                ));
    }
    public function changePasswordAction(Request $request){
//        $user = $this->getUser();
//        $currentPassword = $request->get("CurrentPassword");
//        $newPassword = $request ->get("NewPassword");
//        for ($i=0; $i<10;$i++){
//            $currentPassword = hash("sha512",$currentPassword);
//        }
        
//        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
//            $error = $request->attributes->get(
//                SecurityContext::AUTHENTICATION_ERROR
//        );
//        $defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 10);
//        $mensaje = "defaultEncoder: " . $defaultEncoder. "<br/>";
//        $encoders = array(
//            'Symfony\\Component\\Security\\Core\\User\\User' => $defaultEncoder,
//        );
//        $encoderFactory = new \Symfony\Component\Security\Core\Encoder\EncoderFactory($encoders);
//        $encoder = $encoderFactory->getEncoder($user);
//        $validPassword = $encoder->isPasswordValid(
//            $user->getPassword(), // the encoded password
//            $currentPassword,       // the submitted password
//            $user->getSalt()
//        );
//        $password = $user->getPassword();
//        $password = search($user->getId(), 'Users', 'password');
//        $password = $password ['password'];
//        $em = $this->getDoctrine()->getManager();
 
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array("estado" => "error", "msg" => $str));
//        if($validPassword){
//            
//        }
//        else{
//            return new \Symfony\Component\HttpFoundation\JsonResponse(array("estado" => "error", "msg" => "Contraseña no válida"));
//        }
    }
    
    public function changeNameAction    (Request $request){
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array("estado" => "error", "msg" => "Ha Ocurrido un error"));
        
    }
    
    public function changeEmailAction   (Request $request){
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array("estado" => "error", "msg" => "Ha Ocurrido un error"));
        
    }
                      
             
//          EL SIGUIENTE CÓDIGO SE USA PARA DEVOLVER UN OBJETO JSON DEFINIDO EN EL ARRAY QUE SE LE PASA COMO PARAMETRO            
//        return new \Symfony\Component\HttpFoundation\JsonResponse(array("ok" => "ok"));


    public function contactStudentsAction(Request $request, $controller)
    {
        
        $form = $this->createFormBuilder()
            ->add('Nombre', 'text')
            ->add('Apellidos', 'text')
            ->add('Dni', 'text')
            ->getForm();


        $form->handleRequest($request);

    
        if ($form->isValid()) {

            $data = $form->getData();

            $name = 'Nombre: ' . $data['Nombre'];
            $surname = 'Apellidos: ' . $data['Apellidos'];
            $dni = 'Dni: ' . $data['Dni'];

            $message = new Messages();

            $message->setFromUser($this->search($this->getUser()->getUsername(), 'Users', 'username'));
            $message->setToUser($this->search('admin', 'Users', 'username'));
            $message->setSubject('Asignación de alumno/s');
            $message->setMessage($name .' - '. $surname .' - '. $dni);
            $message->setDate(new \Datetime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
                    
            $em->flush(); // Send message

            $msg_flash = 'Mensaje enviado. En breve recibirá una respuesta.';

            $this->get('session')->getFlashBag()->add('message_send', $msg_flash);

            $this->get('session')->getFlashBag()->add(
                        'verificate',
                        'success'
                    );

            return $this->redirect($this->generateUrl('teaching_user_messages'));

        }


        return $this->render(
                'TeachingGeneralBundle:Login:no_data.html.twig',
                array(
                    'controller' => $controller,
                    'message' => '<h2 class="h2">No tiene asignado ningún alumno.</h2><br/>Por favor, rellene el formulario, en breve recibirá una respuesta.',
                    'form' => $form->createView()
                )
        );
    }     
            

        
 

                      
            

        
 
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
    
    
    
    
    
    
    
    
    /**
     * Load students of user
     * 
     * @return type Return students of user
     */
    private function findStudents()
    {
        // Get current user
        $user = $this->getUser()->getId();
        
	// Fields in use
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
	
	return $query->getResult();
	
    }

    
    
    /**
     * Load differents activities of a subject and student
     * 
     * @param type $students
     * @param type $subject
     * @return type
     */
    private function actionSubjects($students, $subject, $controller = null)
    {
	// Create array for students, the first student will be show
	$array = array(); $i = 1;
	
	foreach ($students as $student){
	    
	    // Catch all activities of a student
	    $student_id = $student->getId();
	    $student_name = $student->getName().' '.$student->getSurname();
	    $subject_id = $this->search($subject, 'Subjects', "name")->getId();
	    $activities = $this->getActivitiesStudentsToHave($student_id, $subject_id);
	    $activities_send = $this->getActivitiesStudentsSend($student_id, $subject_id);
	    $activities_pending = $this->getActivitiesStudentsPending($student_id, $subject_id);
	    
	    // Add data in array
	    $array['student'.$i]['id'] = $student_id;
	    $array['student'.$i]['name'] = $student_name;
	    $array['student'.$i]['subject_id'] = $subject_id;
	    $array['student'.$i]['activities'] = $activities;
	    $array['student'.$i]['activities_send'] = $activities_send;
	    $array['student'.$i]['activities_pending'] = $activities_pending;
	    $array['student'.$i]['style'] = ($i == 1)?'block':'none';
	    
	    $i++;
	}
	
	// Return students and activities
	return $this->render(
            'TeachingUserBundle::subjects.html.twig',
            array(
                'controller' => ($controller != null)? $controller : $subject,
                'students' => $array
            )
        );
	
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
		    , ac.description
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
    
    
    
    /**
     * Get activities send of a student
     * 
     * @param type $student_id
     * @param type $subject_id
     * @return type
     */
    private function getActivitiesStudentsSend($student_id, $subject_id)
    {
        // Entities required to generate JOIN
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
    
    
    
    /**
     * Return activities pending of a student
     * 
     * @param type $student_id
     * @param type $subject_id
     * @return type
     */
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
    
    
    
}
