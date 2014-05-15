<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupsSubjects
 * 
 * @ORM\Table(
 *	name="groups_subjects", 
 *	uniqueConstraints=
 *		{@ORM\UniqueConstraint(
 *		    name="cgs_idx", 
 *		    columns={"group_id", "subject_id", "teacher_id"},
 *		    columns={"group_id", "subject_id"}
 *		)}
 * )
 * @ORM\Entity
 */
class GroupsSubjects
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
     * @ORM\ManyToOne(targetEntity="Subjects")
     */
    private $subject;
    
    /**
     * @ORM\ManyToOne(targetEntity="Users")
     */
    private $teacher;
    
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
     * Set group
     *
     * @param \Teaching\GeneralBundle\Entity\Groups $group
     * @return CourseGroupsSubjects
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
     * Set subject
     *
     * @param \Teaching\GeneralBundle\Entity\Subjects $subject
     * @return CourseGroupsSubjects
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

    /**
     * Set teacher
     *
     * @param \Teaching\GeneralBundle\Entity\Users $teacher
     * @return CourseGroupsSubjects
     */
    public function setTeacher(\Teaching\GeneralBundle\Entity\Users $teacher = null)
    {
        $this->teacher = $teacher;
    
        return $this;
    }

    /**
     * Get teacher
     *
     * @return \Teaching\GeneralBundle\Entity\Users 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
}
