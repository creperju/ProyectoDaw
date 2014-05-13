<?php

namespace Teaching\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class with util methods
 */
class UtilitiesController extends Controller
{
    
    public static function search($user, $entity, $field)
    {
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:' . $entity);
        
        $result = $em->findOneBy(array( $field => $user ));
        
        return $result;
        
    }
    
    
    
    
}