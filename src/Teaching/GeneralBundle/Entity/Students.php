<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Students
 *
 * @ORM\Table(name="students")
 * @ORM\Entity
 */
class Students
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=20)
     */
    private $surname;


    
    /**
     * @ORM\ManyToMany(targetEntity="Users", inversedBy="students")
     * @ORM\JoinTable(name="users_students")
     */
    private $users;
    
    
    
    
    
    
    public function __construct() {
	$this->users = new ArrayCollection();
    }
    
    
    
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
     * Set name
     *
     * @param string $name
     * @return Students
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Students
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add users
     *
     * @param \Teaching\GeneralBundle\Entity\Users $users
     * @return Students
     */
    public function addUser(\Teaching\GeneralBundle\Entity\Users $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Teaching\GeneralBundle\Entity\Users $users
     */
    public function removeUser(\Teaching\GeneralBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
