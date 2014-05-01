<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Teaching\GeneralBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Teaching\GeneralBundle\Entity\UserRepository")
 */
class Users implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=25)
     */
    private $salt;

    /**
     * @ORM\ManyToMany(targetEntity="Roles", inversedBy="users")
     *
     */
    private $roles;    

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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, unique=true)
     */
    private $email;

    
    
    
    ////////////////////////////////////////////////////////////////////////////
    //				    METHODS				      //
    ////////////////////////////////////////////////////////////////////////////
    
    
    public function __construct()
    {
        $this->roles = new ArrayCollection();
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
     * Get username from user
     * 
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    /**
     * Get password encode
     * 
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    /**
     * Get salt to encode password
     * 
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Set salt to encode password
     * 
     * @param type $salt
     * @return \Teaching\GeneralBundle\Entity\Users
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
	return $this;
	
    }
    
    /**
     * Add roles
     *
     * @param \Teaching\GeneralBundle\Entity\Roles $roles
     * @return User
     */
    public function addRoles(\Teaching\GeneralBundle\Entity\Roles $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }
    
    /**
     * Get roles from user
     * 
     * @return type
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }
    
    /**
     * Remove roles
     *
     * @param \Teaching\GeneralBundle\Entity\Roles $roles
     */
    public function removeRole(\Teaching\GeneralBundle\Entity\Roles $roles)
    {
        $this->roles->removeElement($roles);
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
     * Set name
     *
     * @param string $name
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;
    
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
     * Set surname
     *
     * @param string $surname
     * @return Users
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,            
            $this->salt
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
	    $this->salt
        ) = unserialize($serialized);
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    

    
}
