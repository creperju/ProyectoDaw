<?php

namespace Teaching\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Teaching\GeneralBundle\Entity\Messages;
use Datetime;


class AdminController extends Controller
{

    public function indexAction()
    {
        
        $item = array(
            '0' => array(
                'name' => 'Asignaciones',
                'color' => 'white',
                'background' => '#30A7D7',
                'dimension' => '12',
                'offset' => '0',
                'oxs' => '1',
                'dxs' => '10',
                'link' => 'asignaciones'
            )
        );

        
        return $this->render(
            'TeachingAdminBundle::index.html.twig',
            array(
                'item' => $item
            )
        );
        
    }
    
    

    public function affilationsAction(Request $request)
    {
        
        // Messages receibe to this user
        $messages = $this->getMessages();

        $message_id = isset($_POST['id'])?$_POST['id']:'0';


        if( $this->checkMessage($message_id, $messages) ){

            $dni = $this->getDni($message_id);

            $enrollment = $this->enrollment($dni);

            if( $enrollment ){
                echo $enrollment;
                // aquii editar codigo ahora y poner spam!!
                $next = true;
            }
            else{
                echo $enrollment;
                $back = true;
            }

            $this->redirect($this->generateUrl('teaching_admin_affilations'));
        }
        



        return $this->render(
            'TeachingAdminBundle::affilations.html.twig',
            array(
                'messages' => $messages,
                'id'       => $message_id,
                'next'     => isset($next)? $next: false,
                'back'     => isset($back)? $back: false
            )
        );

    }







    private function getMessages($id = null)
    {

        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Messages');
        
        if( $id )
            return $em->findBy(
                array(
                    'id'        => $id,
                    'toUser'    => $this->getUser()->getId()
                )
            );            
        else
            return $em->findBy(array('toUser' => $this->getUser()->getId()));
                
    }
    



    private function checkMessage($id, $messages)
    {

        for( $i=0; $i < count($messages); $i++ ){
            if( $id == $messages[$i]->getId() )
                return true;
        }

        return false;
    }




    private function getDni($message_id)
    {

        $message = $this->getMessages($message_id);

        $dni = $message[0]->getMessage();
        
        return explode("Dni: ", $dni);
    }




    private function enrollment($dni)
    {
        
        $em = $this->getDoctrine()->getRepository('TeachingGeneralBundle:Enrollments');
        
        
        if( count($students = $em->findBy(array('dni_father' => $dni)) ) > 0 )
            return $students;
        elseif( count($students = $em->findBy(array('dni_mother' => $dni)) ) > 0 )
            return $students;
        elseif( count($students = $em->findBy(array('dni_tutor' => $dni)) ) > 0)
            return $students;
        
        return '0';

    }


}
