<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(  name="groups",
 *              uniqueConstraints=
 *                  {@ORM\UniqueConstraint(
 *                      name="g_idx", 
 *                      columns={"course_id", "letter"}
 *                  )}
 * )
 * @ORM\Entity
 */
class Groups
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
     * @ORM\ManyToOne(targetEntity="Courses")
     */
    private $course;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="string", length=1)
     */
    private $letter;

    
    /**
     * @ORM\OneToOne(targetEntity="Users", inversedBy="courseTutor")
     */
    private $tutor;
    
    
    

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
     * Set letter
     *
     * @param string $letter
     * @return Groups
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
    
        return $this;
    }

    /**
     * Get letter
     *
     * @return string 
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Set course
     *
     * @param \Teaching\GeneralBundle\Entity\Courses $course
     * @return Groups
     */
    public function setCourse(\Teaching\GeneralBundle\Entity\Courses $course = null)
    {
        $this->course = $course;
    
        return $this;
    }

    /**
     * Get course
     *
     * @return \Teaching\GeneralBundle\Entity\Courses 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set tutor
     *
     * @param \Teaching\GeneralBundle\Entity\Users $tutor
     * @return Groups
     */
    public function setTutor(\Teaching\GeneralBundle\Entity\Users $tutor = null)
    {
        $this->tutor = $tutor;
    
        return $this;
    }

    /**
     * Get tutor
     *
     * @return \Teaching\GeneralBundle\Entity\Users 
     */
    public function getTutor()
    {
        return $this->tutor;
    }
}
