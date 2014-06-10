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
                
		$c = 0;
		
		if(strlen($data->getUsername()) > 20){
		    
		    $msg_flash= "Error: Longitud de máxima de usuario 20 caracteres.";
		    
		    $this->get('session')->getFlashBag()->add(
			'error_user', $msg_flash
		    );
		    
		    $c++;
		}
		    
		
		if(strlen($data->getPassword()) > 50){
		    
		    $msg_flash= "Error: Longitud máxima de contraseña 50 caracteres.";
		    
		    $this->get('session')->getFlashBag()->add(
			'error_password', $msg_flash
		    );
		    
		    $c++;
		}
		    
		
		if( $this->errorEmail( $data->getEmail() ) > 0 ){
		    
		    $msg_flash= "Error: Email no válido o máximo 50 caracteres.";
		    
		    $this->get('session')->getFlashBag()->add(
			'error_email', $msg_flash
		    );
		    
		    $c++;
		}
		    
		
		if(strlen($data->getName()) > 20){
		    
		    $msg_flash= "Error: Longitud máxima de nombre 20 caracteres.";
		    
		    $this->get('session')->getFlashBag()->add(
			'error_name', $msg_flash
		    );
		    
		    $c++;
		}
		
		if(strlen($data->getSurname()) > 20){
		    
		    $msg_flash= "Error: Longitud máxima de apellidos 20 caracteres.";
		    
		    $this->get('session')->getFlashBag()->add(
			'error_surname', $msg_flash
		    );
		    
		    $c++;
		}
		
		
		if( $c == 0 ){
		    
		    // Signup user with form data
		    $this->signUpUser($user, $data);

		    // Flash message success
		    $this->get('session')->getFlashBag()->add(
			'user_create',
			'Se ha creado el usuario.'
		    );
		    $this->get('session')->getFlashBag()->add(
			'verificate',
			'success'
		    );
		
		}
		else{
		    // Flash message error
		    $this->get('session')->getFlashBag()->add(
			'user_create',
			'Revisa los errores.'
		    );
		    $this->get('session')->getFlashBag()->add(
			'verificate',
			'error'
		    );
		}
		
		
		
            }
            else{
		
                // Flash message error
                $this->get('session')->getFlashBag()->add(
                    'user_create',
                    'El usuario ya está registrado.'
                );
		$this->get('session')->getFlashBag()->add(
                    'verificate',
                    'error'
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
                'form'          => $form->createView()
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
    
    
    /**
     * Control user account
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function redirectAction(Request $request)
    { 

        // Get role of user validate
        $rol = $this->getUser()->getRoles();
        
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
    
    
    
    /**
     * Check email errors
     * 
     * @param type $email
     * @return int
     */
    private function errorEmail($email)
    {
	
	$errors = 0;
	
	$pattern = "/^(\w)([.]*[_]*[-]*\w)*@([a-z])+([.]*[a-z])*[.]([a-z]{2,3})$/";
	
	if(strlen($email) > 50) $errors++;
	if(!preg_match($pattern, $email)) $errors++;
	
	return $errors;
	
    }
    
    
    
    
}
