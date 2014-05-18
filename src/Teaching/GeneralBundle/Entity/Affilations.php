<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Teaching\GeneralBundle\Entity\Users;
use Teaching\GeneralBundle\Entity\Students;


/**
 * Affilations
 *
 * @ORM\Table(name="affilations")
 * @ORM\Entity
 */
class Affilations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Users")
     */
    private $user;

    /**
     * Values: 'Padre', 'Madre', 'Tutor'
     * 
     * @var string
     *
     * @ORM\Column(name="relationship", type="string", length=5)
     */
    private $relationship;

    /**
     * Values: true or false/null
     * 
     * @var boolean
     *
     * @ORM\Column(name="main_responsible", type="boolean")
     */
    private $mainResponsible;

    /**
     * @ORM\ManyToOne(targetEntity="Students")
     */
    private $student;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Affilations
     */
    public function setUser(Users $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set relationship
     *
     * @param string $relationship
     * @return Affilations
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
    
        return $this;
    }

    /**
     * Get relationship
     *
     * @return string 
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Set mainResponsible
     *
     * @param boolean $mainResponsible
     * @return Affilations
     */
    public function setMainResponsible($mainResponsible)
    {
        $this->mainResponsible = $mainResponsible;
    
        return $this;
    }

    /**
     * Get mainResponsible
     *
     * @return boolean 
     */
    public function getMainResponsible()
    {
        return $this->mainResponsible;
    }

    /**
     * Set student
     *
     * @param string $student
     * @return Affilations
     */
    public function setStudent(Students $student)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return string 
     */
    public function getStudent()
    {
        return $this->student;
    }
}
