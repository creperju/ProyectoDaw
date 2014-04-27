<?php

namespace Teaching\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Form\SignUp;

class HomeController extends Controller
{
    public function indexAction(Request $request, $js_user = 0)
    {
        // Form to SignUp user         
	$user = new Users();
	$form = $this->createForm(new SignUp(),$user);
        
        $form->handleRequest($request);
 
        if ($form->isValid()) {
            // Array data form
            $data = $form->getData();
            $this->signUpUser($user, $data);
            
            return $this->redirect($this->generateUrl('teaching_homepage_created'));
        }
        
        
        
        // Security firewalls to access
        
	$session = $request->getSession();
        
        // get the login error if there is one
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
                'js_user'       => $js_user,
            )
        );
	
    }
    
    
    
    private function signUpUser(&$entity, $data)
    {
//        echo $data['username'];exit(0);
        $entity->setUsername($data->getUsername());
        $this->setSecurePassword($entity, $data->getPassword());
        $entity->setRole('ROLE_USER');
        $entity->setName($data->getName());
        $entity->setSurname($data->getSurname());
        $entity->setEmail($data->getEmail());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
        
    }
    
    
    
    private function setSecurePassword(&$entity, $pass)
    {
        //$entity->setSalt(md5(time()));
        $entity->setSalt("");
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword($pass, $entity->getSalt());
        $entity->setPassword($password);
    }
    
    
    public function createdAction()
    { 
//        $this->indexAction(new Request(), 1);
        return new \Symfony\Component\HttpFoundation\Response("<html><body>Usuario credo.</body></html>");
    }
    
}
