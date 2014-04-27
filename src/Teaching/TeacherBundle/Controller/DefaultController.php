<?php

namespace Teaching\TeacherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TeachingTeacherBundle:Default:index.html.twig', array('name' => $name));
    }
}
