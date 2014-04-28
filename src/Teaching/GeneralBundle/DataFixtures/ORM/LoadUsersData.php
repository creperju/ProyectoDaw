<?php

namespace Teaching\GeneralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Teaching\GeneralBundle\Entity\Users;

class LoadUsersData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $emilio = new Users();
        $emilio->setUsername('emilio');
        $emilio->setPassword('emilio');
	$emilio->setSalt('codificador de contraseña');
	$emilio->setName('Emilio');
	$emilio->setSurname('Crespo Peran');
	$emilio->setEmail('emiliocresxperia@gmail.com');
	$emilio->setRole('ROLE_ADMIN');
	
	
        $manager->persist($emilio);
        $manager->flush();
    }
}