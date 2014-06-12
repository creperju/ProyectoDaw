<?php

namespace Teaching\GeneralBundle\Tests\Controller;
 
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Teaching\GeneralBundle\Entity\Users;

class HomeControllerTest extends WebTestCase
{
	
	
    public function testSignUp()
    {

        // Create web client
        $client = static::createClient();
 
        // Go to home app
        $crawler = $client->request('GET', '/');

        // crawler extract different parts of page
        // send forms, get divs, etc



        $form = $crawler->selectButton('Registrarse')->form();
 
        // values in form
        $form['signup[username]'] = 'emilio';
        $form['signup[password]'] = 'emilio';
        $form['signup[email]'] = 'ee@ee.es';
        $form['signup[name]'] = 'emilio';
        $form['signup[surname]'] = 'crespo';


        // Send form
        $crawler = $client->submit($form);



    }

    
}