<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Entity\Messages;
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
	
	
	
	
	$this->loadMessages(
		$manager,
		$user, 
		$user2, 
		'Ejemplo', 
		'Esto es un ejemplo de mensaje'
		);
	
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
    
    
    
    
    
    
}