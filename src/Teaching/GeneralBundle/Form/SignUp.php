<?php

namespace Teaching\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SignUp extends AbstractType
{
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('email', 'text')
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('registrar', 'submit');
    }
 
    public function getName()
    {
        return 'signup';
    }
    
    
}