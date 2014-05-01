<?php

namespace Teaching\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Form\SignUp;

class HomeController extends Controller
{
    /**
     * First method of app that show homepage with login and signup users.
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function indexAction(Request $request)
    {
        // Form to SignUp user
	$user = new Users();
	$form = $this->createForm(new SignUp(),$user);
        
        $form->handleRequest($request);
 
	// If form is valid and has been sent from user, it's true
        if ($form->isValid()){
	    
            // Array data form
            $data = $form->getData();
	    
	    // Signup user with form data
            $this->signUpUser($user, $data);
            
	    // Flash message
	    $this->get('session')->getFlashBag()->add(
		'user_create',
		'Se ha creado el usuario.'
	    );
	    
            return $this->redirect($this->generateUrl('teaching_homepage'));
	    
        }
        
        
        
        // Security firewalls to access
        
	$session = $request->getSession();
        
        // Get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        return $this->render(
            'TeachingGeneralBundle:Home:index.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
                'form'          => $form->createView(),
            )
        );
	
    }
    
    
    /**
     * Signup user of form to home
     * 
     * @param type $entity
     * @param type $data
     */
    private function signUpUser(&$entity, $data)
    {
	// Users signup from home, they have ROLE_USER
	// Only Admin, can be change the role of users
	$role = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Roles')->findOneByRole('ROLE_USER');
	
	
	$entity->setUsername($data->getUsername());		    // Set username
        $this->setSecurePassword($entity, $data->getPassword());    // Set password secure
        $entity->addRoles($role);				    // Add ROLE_USER
        $entity->setName($data->getName());			    // Set name
        $entity->setSurname($data->getSurname());		    // Set surname
        $entity->setEmail($data->getEmail());			    // Set email
        
	
//	$entity->setUsername('emi');		    // Set username
//        $this->setSecurePassword($entity, 'emi');    // Set password secure
//        $entity->addRoles($role);				    // Add ROLE_USER
//        $entity->setName('emi');			    // Set name
//        $entity->setSurname('emi');		    // Set surname
//        $entity->setEmail('emi');	
	
	
	
	
	
	
	// Persist user
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
        
    }
    
    
    /**
     * Set a secure password
     * 
     * @param type $entity
     * @param type $pass
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
    
    
    
    
    public function finAction()
    { 
        return new \Symfony\Component\HttpFoundation\Response("<html><head><title>ENHORABUENA</title></head><body>USUARIO VALIDADO</body></html>");
    }
    
    
}
