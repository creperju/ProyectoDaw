<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Entity\Messages;
use Teaching\GeneralBundle\Entity\Students;
use Teaching\GeneralBundle\Entity\Affilations;
use Teaching\GeneralBundle\Entity\Courses;
use Teaching\GeneralBundle\Entity\Groups;
use Teaching\GeneralBundle\Entity\Enrollments;
use Teaching\GeneralBundle\Entity\Subjects;
use Teaching\GeneralBundle\Entity\GroupsSubjects;
use Teaching\GeneralBundle\Entity\Activities;
use Teaching\GeneralBundle\Entity\ActivitiesStudents;
use Teaching\GeneralBundle\Entity\Ratings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DateTime;


/**
 * LoadUsersData
 * 
 * Add basic examples to run application.
 * It must be extends Controller, unless not get security encoder to encoder password users.
 * 
 */
class LoadUsersData extends Controller implements FixtureInterface 
{
    /**
     * Method to add users example in application.
     * 
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Load users
	$this->loadUsers($manager);
        
        // Load messages
	$this->loadMessages($manager);
        
        // Load students
	$this->loadStudents($manager);
        
        // Add relationship Users <> Students
	$this->loadAffilations($manager);
	
        // Load courses
        $this->loadCourses($manager);
	
        // Load groups
        $this->loadGroups($manager);
        
        // Load enrollments, students <> groups
        $this->loadEnrollments($manager);
        
        // Load subjects
        $this->loadSubjects($manager);
        
        // Load Subjects <> Courses
        $this->loadGroupsSubjects($manager);
	
	// Load activities <> groups 
	$this->loadActivities($manager);
	
        // Load activities <> students
        $this->loadActivitiesStudents($manager);
        
        // Load ratings students
        $this->loadRatings($manager);
        
    }
    
    
    
    /**
     * Add new users for example
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadUsers(ObjectManager $manager)
    {
        // Contain users examples
        $data = array(
            '0' => array(
                'username'  => 'emilio',
                'password'  => 'emilio',
                'rol'       => 'ROLE_USER',
                'name'      => 'Emilio',
                'surname'   => 'Crespo Perán',
                'email'     => 'emiliocresxperia@gmail.com'
            ),
            '1' => array(
                'username'  => 'fran',
                'password'  => 'fran',
                'rol'       => 'ROLE_USER',
                'name'      => 'Fran',
                'surname'   => 'González Navarro',
                'email'     => 'fran@gmail.com'
            ),
        );
        
        // Persist some users into database
        foreach($data as $users => $user){
            $class = new Users();
            $class->setUsername($user['username']);
            $this->setSecurePassword($class, $user['password']);
            $class->addRoles($user['rol']);
            $class->setName($user['name']);
            $class->setSurname($user['surname']);
            $class->setEmail($user['email']);
            $manager->persist($class);
        }
        
	$manager->flush();
	
    }
    
    
    
    /**
     * Load some messages examples.
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param type $from_user
     * @param type $to_user
     * @param type $subject
     * @param type $text
     */
    private function loadMessages(ObjectManager $manager)
    {
        // Messages examples
        $data = array(
            '0' => array(
                'from_user' => 'emilio',
                'to_user'   => 'fran',
                'subject'   => 'Ej',
                'message'   => 'Ejemplo de mensaje'
            )
        );
        
        // Persist some messages into database
        foreach($data as $messages => $message){
            $class = new Messages();
            
            $from = $this->search($message['from_user'], 'Users', 'username');
            $to = $this->search($message['to_user'], 'Users', 'username');
            
            $class->setFromUser($from);
            $class->setToUser($to);
            $class->setSubject($message['subject']);
            $class->setMessage($message['message']);
            $class->setDate(new \Datetime());
            
            $manager->persist($class);
        }
        
	$manager->flush();
        
    }
    
    
    
    /**
     * Load new student and new relationship with users
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param type $user
     * @param type $name
     * @param type $surname
     */
    private function loadStudents(ObjectManager $manager)
    {
        // Contain some students
        $data = array(
            '0' => array(
                'name'      => 'Pablo',
                'surname'   => 'Crespo Perán',
                'dni'       => '55578963A'
            ),
            '1' => array(
                'name'      => 'Pepe',
                'surname'   => 'González Navarro',
                'dni'       => '50281490K'
            )
        );
        
        // Persist some students into database
        foreach($data as $students => $student){
            $class = new Students();
            
            $class->setName($student['name']);
            $class->setSurname($student['surname']);
            $class->setDni($student['dni']);
            
            $manager->persist($class);
        }        
                
	$manager->flush();
	
    }
    
    
    
    /**
     * Add relationship Users <> Students
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param type $user Object User
     * @param type $student Object Student
     * @param type $relation Padre, Madre, Tutor
     * @param type $main Main responsible (true, false)
     */
    private function loadAffilations(ObjectManager $manager)
    {
	// Affilations examples
        $data = array(
            '0' => array(
                'user'      => 'emilio',
                'student'   => '55578963A',
                'relation'  => 'Padre',
                'main'      => true
            ),
            '1' => array(
                'user'      => 'fran',
                'student'   => '50281490K',
                'relation'  => 'Padre',
                'main'      => false
            )
        );
        
        // Persist users and students relation
        foreach($data as $affilations => $affilation){
            $class = new Affilations();
            
            $user = $this->search($affilation['user'], 'Users', 'username');
            $student = $this->search($affilation['student'], 'Students', 'dni');
            
            $class->setUser($user);
            $class->setStudent($student);
            $class->setRelationship($affilation['relation']);
            $class->setMainResponsible($affilation['main']);
            
            $manager->persist($class);
            
        }
        
	$manager->flush();
	
    }
    
    
    
    /**
     * Load courses in application
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadCourses(ObjectManager $manager)
    {
        // Contain all courses in application
        $data = array(
            '1º','2º','3º','4º','5º','6º'
        );
        
        // Persist each course to insert in database
        foreach($data as $course){
            $class = new Courses();
            $class->setCourse($course);
            $manager->persist($class);
        }
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Load groups in application
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadGroups(ObjectManager $manager)
    {
        // Groups with tutor and course
        $data = array(
            '0' => array(
                'course' => '1º',
                'letter' => 'A',
                'tutor' => 'emilio'
            ),
            '1' => array(
                'course' => '1º',
                'letter' => 'B',
                'tutor' => 'fran'
            ),
        );
        
        // Persist groups to insert into database
        foreach($data as $groups => $group){
            $class = new Groups();
            
            $course = $this->search($group['course'], 'Courses', 'course');
            $tutor = $this->search($group['tutor'], 'Users', 'username');
            
            $class->setCourse($course);
            $class->setLetter($group['letter']);
            $class->setTutor($tutor);
            
            $manager->persist($class);
        }
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Load enrollments to students
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadEnrollments(ObjectManager $manager)
    {
        // Data of enrollments
        $data = array(
            '0' => array(
                'student'   => '55578963A',
                'course'    => '1º',
                'letter'    => 'A'
            ),
            '1' => array(
                'student'   => '50281490K',
                'course'    => '1º',
                'letter'    => 'B'
            ),
        );
        
        // Persists enrollments
        foreach($data as $enrollments => $enrollment){
            $class = new Enrollments();
            
            $student = $this->search($enrollment['student'], 'Students', 'dni');
            $group = $this->searchGroup($enrollment['course'], $enrollment['letter']);
            
            $class->setGroup($group);
            $class->setStudent($student);
            $class->setDateStart(new \Datetime());
            
            $manager->persist($class);
        }
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Load subjects in application
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadSubjects(ObjectManager $manager)
    {
        // Contain all subjects in application
        $data = array(
            'Lengua', 'Matemáticas', 'Inglés', 'Música', 'Conocimiento del Medio', 'Gimnasia'
        );
        
        // Persists each subject
        foreach($data as $subject){
            $class = new Subjects();
            $class->setName($subject);
            $manager->persist($class);
        }
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Load subjects in courses
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadGroupsSubjects(ObjectManager $manager)
    {
	// Courses with groups
//	$courses = array(
//	    '1º' => array(
//		'A' => array(),
//		'B' => array()
//	    ),
//	    '2º' => array(
//		'A' => array(),
//		'B' => array()
//	    ),
//	    '3º' => array(
//		'A' => array(),
//		'B' => array()
//	    ),
//	    '4º' => array(
//		'A' => array(),
//		'B' => array()
//	    ),
//	    '5º' => array(
//		'A' => array(),
//		'B' => array()
//	    ),
//	    '6º' => array(
//		'A' => array(),
//		'B' => array()
//	    )
//	);
	
	// Subjects in courses
//	$subjects = array('Lengua', 'Matemáticas', 'Inglés', 'Música', 'Conocimiento del Medio', 'Gimnasia');
	
	
	$courses = array(
	    '1º' => array(
		'A' => array('emilio')
	    )
	);
	
	
	$subjects = array('Matemáticas');
	
	
	// Persist teacher, subject, group
	foreach($courses as $course => $groups){
	    
	    foreach($groups as $group => $teachers){
		
		// For every group, there are a teacher wich teach a subject
		for($i = 0; $i < count($group); $i++){
		    $class = new GroupsSubjects();
		    
		    $class->setGroup($this->searchGroup($course, $group));
		    $class->setSubject($this->search($subjects[$i], 'Subjects', 'name'));
		    $class->setTeacher($this->search($teachers[$i], 'Users', 'username'));
		    
		    $manager->persist($class);
		}
		
	    }
		
	}
	
	$manager->flush();
	
    }
    
    
    
    /**
     * Load activities
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadActivities(ObjectManager $manager)
    {
	//
	$data = array(
	    '1º' => array(
		'A' => array(
		    'Matemáticas' => array(
			'0' => array(
			    'Activity_name' => 'Tarea para casa',
			    'Type' => 'Ejercicios',
			    'Description' => 'Ejercicios 1, 2, 3 y 4 de la página 17.',
			    'Date_start' => new \Datetime(),
			    'Date_end' => new \Datetime(),
			),
		    ),
		),
	    ),
	);
	
	// Add activities
	foreach($data as $courses => $course){
	    
	    foreach($course as $groups => $group){

		foreach($group as $subjects => $subject){

		    foreach($subject as $activities => $activity){

			$class = new Activities();

			$class->setGroupSubject($this->searchGroupSubject($courses, $groups, $subjects));
			$class->setActivityName($activity['Activity_name']);
			$class->setType($activity['Type']);
			$class->setDescription($activity['Description']);
			$class->setDateStart($activity['Date_start']);
			$class->setDateEnd($activity['Date_end']);
			
			$manager->persist($class);
		    }

		}

	    }
	    
	}
	
	$manager->flush();
	
    }
    
    
    
    /**
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadActivitiesStudents(ObjectManager $manager)
    {
        // Contain some activities <> students
        $data = array(
            '1º' => array(
                'A' => array(
                    'Matemáticas' => array(
                        '0' => array(
                            'name'          => 'Tarea para casa',
			    'type'          => 'Ejercicios',
			    'description'   => 'Ejercicios 1, 2, 3 y 4 de la página 17.',
                            'students' => array(
                                '0' => array(
                                    'student'       => '55578963A',
                                    'state'         => null,
                                    'score'         => null,
                                    'observations'  => 'No Entregado',
                                    'date'          => new \Datetime()
                                ),
                                '1' => array(
                                    'student'       => '50281490K',
                                    'state'         => 'Entregado.',
                                    'score'         => 8,
                                    'observations'  => 'Entregado correctamente',
                                    'date'          => new \Datetime()
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
        
        // Persist activities students
        foreach($data as $courses => $course){
            
            foreach($course as $groups => $group){
                
                foreach($group as $subjects => $subject){
                    
                    foreach($subject as $activities => $activity){
;
                        $activity_name = $activity['name'];
                        $activity_type = $activity['type'];
                        $activity_description = $activity['description'];
                        $students = $activity['students'];
                        
                        foreach($students as $student){
                            
                            $class = new ActivitiesStudents();
                            
                            $class->setActivity($this->searchActivity($activity_name, $activity_type, $activity_description, $courses, $groups, $subjects)); 
                            $class->setStudent($this->search($student['student'], 'Students', 'dni'));
                            $class->setDate($student['date']);
                            $class->setState($student['state']);
                            $class->setScore($student['score']);
                            $class->setObservations($student['observations']);
                            
                            $manager->persist($class);
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
        
        
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Load ratings students
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadRatings(ObjectManager $manager)
    {
        // Contains some ratings <> students
        $data = array(
            'Matemáticas' => array(
                '0' => array(
                    'student'   => '55578963A',
                    'mark'      => '8',
                    'date'      => new \Datetime()
                ),
                '1' => array(
                    'student'   => '50281490K',
                    'mark'      => '9',
                    'date'      => new \Datetime()
                ),
            ),
        );
        
        // Persist ratings students
        foreach($data as $subjects => $subject){
            
            foreach($subject as $students){
                $class = new Ratings();
                
                $class->setStudent($this->search($students['student'], 'Students', 'dni'));
                $class->setSubject($this->search($subjects, 'Subjects', 'name'));
                $class->setMark($students['mark']);
                $class->setDate($students['date']);
                
                $manager->persist($class);
                
            }
            
        }
        
        $manager->flush();
        
    }
    
    
    
    /**
     * Set a secure password
     * 
     * @param type $entity Object users
     */
    private function setSecurePassword(&$entity, $pass)
    {
        // Get algorithm and encode user
        $factory = $this->get('security.encoder_factory');
	$encoder = $factory->getEncoder($entity);
	
	// Set salt to encode password
	$entity->setSalt( md5(time() * rand(1, 9999)) );
	$password_secure = $encoder->encodePassword($pass, $entity->getSalt()); 
	
        // Set a secure password
        $entity->setPassword($password_secure);
    }
    
    
    
    /**
     * Find object in database
     * 
     * @param type $data Username, name student, course, etc
     * @param type $entity Entity
     * @param type $field Entity's field
     * @return type Object exists
     */
    private function search($data, $entity, $field)
    {
        // Entity to find user/student... Etc
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:'.$entity);
        
        // Find user exists
        $query = $em->findOneBy(array($field => $data));
        
        // Return user
        return $query;
    }
    
    
    
    /**
     * Find course group
     * 
     * @param type $course Get Course
     * @param type $letter Get Letter
     * @return type Course Group
     */
    private function searchGroup($course, $letter)
    {
        // Search course
        $course_id = $this->search($course, 'Courses', 'course');
        
        // Entity to find a course group
        $em = $this->getDoctrine()
                ->getRepository('TeachingGeneralBundle:Groups');
        
        // Find group
        $query = $em->findOneBy(array('course' => $course_id, 'letter' => $letter));
        
        // Return group
        return $query;
    }
    
    
    
    /**
     * Find course subjects
     * 
     * @param type $course
     * @param type $letter
     * @param type $subject
     * @return type
     */
    private function searchGroupSubject($course, $letter, $subject)
    {
	// Search subject
	$subject_id = $this->search($subject, 'Subjects', 'name');
	// Search group
	$group_id = $this->searchGroup($course, $letter);
	
	// Entity to find a course group
        $em = $this->getDoctrine()
                ->getRepository('TeachingGeneralBundle:GroupsSubjects');
        
	// Find group subject
	$query = $em->findOneBy(array('group' => $group_id, 'subject' => $subject_id));
        
        // Return group subject
        return $query;
    }
    
    
    /**
     * Return activity
     * 
     * @param type $name Name activity
     * @param type $type Type activity
     * @param type $description Description activity
     * @return type
     */
    private function searchActivity($name, $type, $description, $course, $letter, $subject)
    {
        
        $group_subject_id = $this->searchGroupSubject($course, $letter, $subject);

        // Entity to find a course group
        $em = $this->getDoctrine()
                ->getRepository('TeachingGeneralBundle:Activities');
        
        $query = $em->findOneBy(array('groupSubject' => $group_subject_id, 'activityName' => $name, 'type' => $type, 'description' => $description));
        
        return $query;
    }
    
    
}