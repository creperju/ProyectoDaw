<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enrollments
 *
 * @ORM\Table(  name="enrollments",
 *              uniqueConstraints=
 *                  {@ORM\UniqueConstraint(
 *                      name="e_idx", 
 *                      columns={"student_id", "date_start"}
 *                  )}
 * )
 * @ORM\Entity
 */
class Enrollments
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
     * @ORM\ManyToOne(targetEntity="Groups")
     */
    private $group;
    
    /**
     * @ORM\ManyToOne(targetEntity="Students")
     */
    private $student;
    
    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $dni_father;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $dni_mother;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $dni_tutor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;


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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Enrollments
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    
        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Enrollments
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    
        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set group
     *
     * @param \Teaching\GeneralBundle\Entity\Groups $group
     * @return Enrollments
     */
    public function setGroup(\Teaching\GeneralBundle\Entity\Groups $group = null)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return \Teaching\GeneralBundle\Entity\Groups 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set student
     *
     * @param \Teaching\GeneralBundle\Entity\Students $student
     * @return Enrollments
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
     * Set dni_father
     *
     * @param string $dniFather
     * @return Enrollments
     */
    public function setDniFather($dniFather)
    {
        $this->dni_father = $dniFather;
    
        return $this;
    }

    /**
     * Get dni_father
     *
     * @return string 
     */
    public function getDniFather()
    {
        return $this->dni_father;
    }

    /**
     * Set dni_mother
     *
     * @param string $dniMother
     * @return Enrollments
     */
    public function setDniMother($dniMother)
    {
        $this->dni_mother = $dniMother;
    
        return $this;
    }

    /**
     * Get dni_mother
     *
     * @return string 
     */
    public function getDniMother()
    {
        return $this->dni_mother;
    }

    /**
     * Set dni_tutor
     *
     * @param string $dniTutor
     * @return Enrollments
     */
    public function setDniTutor($dniTutor)
    {
        $this->dni_tutor = $dniTutor;
    
        return $this;
    }

    /**
     * Get dni_tutor
     *
     * @return string 
     */
    public function getDniTutor()
    {
        return $this->dni_tutor;
    }
}
