<?php

namespace Teaching\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Acme\ConfigBundle\Entity\Users;
//use Acme\ConfigBundle\Form\Login;


class AdminController extends Controller
{

    public function indexAction(Request $request)
    {
        
        
	$user = $request->getSession()->get('user');
        
        return $this->render('TeachingAdminBundle:Default:pruebas.html.twig', array('user' => $user));
        
    }
    
    
    
    
}
