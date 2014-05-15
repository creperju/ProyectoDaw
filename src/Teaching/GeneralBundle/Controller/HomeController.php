<?php

namespace Teaching\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Form\SignUp;
use Teaching\GeneralBundle\Controller\UtilitiesController;

class HomeController extends Controller
{
    
    
    /**
     * First method in application, load the home of application, also
     * load form sign up for new users and form login.
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
            
            // If user not exits
            if(! $this->search($data->getUsername(), 'Users', 'username') ){
                // Signup user with form data
                $this->signUpUser($user, $data);

                // Flash message
                $this->get('session')->getFlashBag()->add(
                    'user_create',
                    'Se ha creado el usuario.'
                );

            }
            else{
                // Flash message
                $this->get('session')->getFlashBag()->add(
                    'user_create',
                    'El usuario ya está registrado.'
                );
                
            }
            
            
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
	$entity->setUsername($data->getUsername()); // Set username
        $this->setSecurePassword($entity, $data->getPassword()); // Set a secure password
        $entity->addRoles("ROLE_USER"); // Add ROLE_USER
        $entity->setName($data->getName()); // Set name
        $entity->setSurname($data->getSurname()); // Set surname
        $entity->setEmail($data->getEmail()); // Set email
        
	
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
    
    
    /**
     * Search something in database
     * 
     * @param type $data
     * @param type $entity
     * @param type $field
     * @return type
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
    
    
    
    // Control user account
    public function redirectAction(Request $request)
    { 
//        return new \Symfony\Component\HttpFoundation\Response("<html><head><title>ENHORABUENA</title></head><body>USUARIO VALIDADO</body></html>");
        
        /**
         * SWITCH CASE OF TYPE ACCOUNTS USERS!!
         */
        
        // Get role of user validate
        $rol = $this->getUser()->getRoles();
        
//        echo $session->getUsername()." es el usuario<br/>";
//        echo $session->getEmail()." es su correo.<br/>";
//        echo $rol[0]. " es su rol definido<br/>";
//        echo $session->getName()." es su nombre real.<br/>";
//        echo $session->getSurname()." son sus apellidos";
//        
//        return $this;
        
        
        // Redirect to type of user account
        switch($rol[0])
        {
            case "ROLE_USER":
                return $this->redirect($this->generateUrl('teaching_user_homepage'));
                break;
            case "ROLE_TEACHER":
                return $this->redirect($this->generateUrl('teaching_teacher_homepage'));
                break;
            case "ROLE_ADMIN":
                return $this->redirect($this->generateUrl('teaching_admin_homepage'));
                break;
            default:
                return $this->redirect($this->generateUrl('teaching_homepage'));
                
        }
        
        
    }
    
    
}
