<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Entity\Roles;


class LoadUsersData extends Controller implements FixtureInterface 
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
	// Load roles
	$this->loadRoles($manager);
	
	$this->loadUser($manager);
	// If there aren't roles in application, add all roles
//	if( ! $this->getDoctrine()->getRepository('TeachingGeneralBundle:Roles')->findAll() ){
	    
	    
//	}
	
	// Load an user example
//	if( ! $this->getDoctrine()->getRepository('TeachingGeneralBundle:Users')->findOneByUsername('emilio') ){
	    
	    // Role by default user example
//	    $admin_role = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Roles')->findOneByRole('ROLE_ADMIN');
//	    
//	    // Add new user example
//	    $user = new Users();
//	    $user->setUsername('emilio');
//	    $this->setSecurePassword($user);
//	    $user->addRoles($role_user);
//	    $user->setName('Emilio');
//	    $user->setSurname('Crespo Perán');
//	    $user->setEmail('emiliocresxperia@gmail.com');
//	    
//	    // Persist user example
//	    $manager->persist($user);
//	    $manager->flush();
//	}
	
        
       
    }
    
    
    
    private function loadRoles(ObjectManager $manager)
    {
	
	
	// Add all roles of application
	$rol_user = new Roles();	$rol_user->setRole('ROLE_USER');	$rol_user->setName('Rol de usuarios');
	$rol_teacher = new Roles();	$rol_teacher->setRole('ROLE_TEACHER');  $rol_teacher->setName('Rol de profesores');
	$rol_admin = new Roles();	$rol_admin->setRole('ROLE_ADMIN');	$rol_admin->setName('Rol de administradores');

	// Persist all roles
	$manager->persist($rol_user);
	$manager->persist($rol_teacher);
	$manager->persist($rol_admin);
	
	$manager->flush();
	
	
	
    }
    
    
    
    private function loadUser(ObjectManager $manager)
    {
	
	
	
	// Role by default user example
	$admin_role = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Roles')->findOneByRole('ROLE_ADMIN');

	// Add new user example
	$user = new Users();
	$user->setUsername('emilio');
	$this->setSecurePassword($user);
	$user->addRoles($admin_role);
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