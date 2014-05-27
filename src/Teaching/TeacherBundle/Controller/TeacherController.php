<?php

namespace Teaching\TeacherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TeacherController extends Controller
{
    public function indexAction()
    {
        // Deny users if they are admin
        if (!$this->get('security.context')->isGranted("ROLE_TEACHER")) {
            throw new AccessDeniedException();
        }
        
        
    }
}
