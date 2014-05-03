<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Teaching\GeneralBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
	$this->setSecurePassword($user);
	$user->addRoles("ROLE_ADMIN");
	$user->setName('Emilio');
	$user->setSurname('Crespo Perán');
	$user->setEmail('emiliocresxperia@gmail.com');

	// Persist user example
	$manager->persist($user);
	$manager->flush();
	
    }
    
    
    
    /**
     * Set a secure password
     * 
     * @param type $entity Object users
     */
    private function setSecurePassword(&$entity)
    {
        // Get algorithm and encode user
        $factory = $this->get('security.encoder_factory');
	$encoder = $factory->getEncoder($entity);
	
	// Set salt to encode password
	$entity->setSalt( md5(time() * rand(1, 9999)) );
	$password_secure = $encoder->encodePassword('emilio', $entity->getSalt()); 
	
        // Set a secure password
        $entity->setPassword($password_secure);
    }
    
    
    
}