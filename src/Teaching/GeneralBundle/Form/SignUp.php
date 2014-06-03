<?php

namespace Teaching\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SignUp extends AbstractType
{
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('max_length' => 20))
            ->add('password', 'password', array('max_length' => 50))
            ->add('email', 'text', array('max_length' => 50))
            ->add('name', 'text', array('max_length' => 20))
            ->add('surname', 'text', array('max_length' => 20));
    }
 
    public function getName()
    {
        return 'signup';
    }
    
    
}