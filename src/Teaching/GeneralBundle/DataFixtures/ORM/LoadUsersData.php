<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Entity\Messages;
use Teaching\GeneralBundle\Entity\Students;
use Teaching\GeneralBundle\Entity\Affilations;
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
        // Load an example user
	$this->loadUser($manager);
    }
    
    
    
    /**
     * Add new users for example.
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    private function loadUser(ObjectManager $manager)
    {
	// User emilio
	$user = new Users();
	$user->setUsername('emilio');
	$this->setSecurePassword($user, 'emilio');
	$user->addRoles("ROLE_ADMIN");
	$user->setName('Emilio');
	$user->setSurname('Crespo Perán');
	$user->setEmail('emiliocresxperia@gmail.com');

	
	// User fran
	$user2 = new Users();
	$user2->setUsername('fran');
	$this->setSecurePassword($user2, 'fran');
	$user2->addRoles("ROLE_ADMIN");
	$user2->setName('Fran');
	$user2->setSurname('González Navarro');
	$user2->setEmail('fran@gmail.com');
	
	
	
	
	// Persist users example
	$manager->persist($user);
	$manager->persist($user2);
	$manager->flush();
	
	
	
	// Load messages examples
	$this->loadMessages(
		$manager,
		$user, 
		$user2, 
		'Ejemplo', 
		'Esto es un ejemplo de mensaje'
		);
	
	
	// Add student
	$student = $this->loadStudents($manager, 'Hijo de emilio', 'Crespo');
	
	
	// Add relationship Users <> Students
	$this->loadAffilations($manager, $user, $student, 'Padre', true);
	
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
     * Load some messages examples.
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param type $from_user
     * @param type $to_user
     * @param type $subject
     * @param type $text
     */
    private function loadMessages(ObjectManager $manager, $from_user, $to_user, $subject, $text)
    {
	// Insert new Message
	$message = new Messages();
	
	$message->setFromUser($from_user);
	$message->setToUser($to_user);	
	$message->setSubject($subject);
	$message->setMessage($text);
	$message->setDate(new Datetime());
	
	$manager->persist($message);	
	$manager->flush();
    }
    
    
    /**
     * Load new student and new relationship with users.
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param type $user
     * @param type $name
     * @param type $surname
     */
    private function loadStudents(ObjectManager $manager, $name, $surname)
    {
	$student = new Students();
	$student->setName($name);
	$student->setSurname($surname);
	
	$manager->persist($student);
	$manager->flush();
	
	return $student;
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
    private function loadAffilations(ObjectManager $manager, $user, $student, $relation, $main)
    {
	
	$affilation = new Affilations();
	
	$affilation->setUser($user);
	$affilation->setStudent($student);
	$affilation->setRelationship($relation);
	$affilation->setMainResponsible($main);
		
	$manager->persist($affilation);
	$manager->flush();
	
    }
    
    
}