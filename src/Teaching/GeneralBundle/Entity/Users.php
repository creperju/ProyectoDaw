<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Teaching\GeneralBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity()
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=88)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=12)
     *
     */
    private $roles = ' ';

     /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;
    
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;
    
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $surname;
    
    /**
     * @ORM\ManyToMany(targetEntity="Students", mappedBy="users")
     */
    private $students;
    
    
    
    
    public function __construct()
    {
	$this->students = new ArrayCollection();
    }
    
    
    
    
    
    
    
    
    
    public function getName(){ return $this->name; }
    public function setName($name){ $this->name = $name; return; }
    
    public function getSurname(){ return $this->surname; }
    public function setSurname($surname){ $this->surname = $surname; return; }
    
    
    

    public function getRoles()
    {
        return explode(' ',$this->roles);
    }
    
    
    
    
    public function setSalt($salt)
    {
        $this->salt = $salt;
	return $this;
	
    }
    
    
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
//            $this->username,
//            $this->password,
//            // see section on salt below
//            $this->salt,
//            $this->name,
//            $this->surname,
//            $this->email,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
//            $this->username,
//            $this->password,
//            // see section on salt below
//            $this->salt,
//            $this->name,
//            $this->surname,
//            $this->email,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add roles
     *
     * @param \Teaching\GeneralBundle\Entity\Roles $roles
     * @return Users
     */
    public function addRoles($rol)
    {
        $this->roles = $rol;

        return $this;
    }

    

    /**
     * Set roles
     *
     * @param string $roles
     * @return Users
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    
        return $this;
    }

    /**
     * Add students
     *
     * @param \Teaching\GeneralBundle\Entity\Students $students
     * @return Users
     */
    public function addStudent(\Teaching\GeneralBundle\Entity\Students $students)
    {
        $this->students[] = $students;
    
        return $this;
    }

    /**
     * Remove students
     *
     * @param \Teaching\GeneralBundle\Entity\Students $students
     */
    public function removeStudent(\Teaching\GeneralBundle\Entity\Students $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
}
