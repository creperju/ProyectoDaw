<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 *
 * @ORM\Table(  name="ratings",
 *              uniqueConstraints=
 *                  {@ORM\UniqueConstraint(
 *                      name="r_idx", 
 *                      columns={"student_id", "subject_id", "date"}
 *                  )}
 * )
 * @ORM\Entity
 */
class Ratings
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
     *
     * @ORM\ManyToOne(targetEntity="Students") 
     */
    private $student;
    
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Subjects")
     */
    private $subject;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="mark", type="integer")
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


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
     * Set mark
     *
     * @param integer $mark
     * @return Ratings
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
    
        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Ratings
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set student
     *
     * @param \Teaching\GeneralBundle\Entity\Students $student
     * @return Ratings
     */
    public function setStudent(\Teaching\GeneralBundle\Entity\Students $student = null)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return \Teaching\GeneralBundle\Entity\Students 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set subject
     *
     * @param \Teaching\GeneralBundle\Entity\Subjects $subject
     * @return Ratings
     */
    public function setSubject(\Teaching\GeneralBundle\Entity\Subjects $subject = null)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return \Teaching\GeneralBundle\Entity\Subjects 
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
