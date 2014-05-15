<?php

namespace Teaching\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activities
 *
 * @ORM\Table(  name="activities",
 *              uniqueConstraints=
 *                  {@ORM\UniqueConstraint(
 *                      name="a_idx", 
 *                      columns={"id", "groupSubject_id"}
 *                  )}
 * )
 * @ORM\Entity
 */
class Activities
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
     * @ORM\ManyToOne(targetEntity="GroupsSubjects")
     */
    private $groupSubject;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="activity_name", type="string", length=100)
     */
    private $activityName;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
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
     * Set activityName
     *
     * @param string $activityName
     * @return Activities
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;
    
        return $this;
    }

    /**
     * Get activityName
     *
     * @return string 
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Activities
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Activities
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Activities
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
     * @return Activities
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
     * Set groupSubject
     *
     * @param \Teaching\GeneralBundle\Entity\GroupsSubjects $groupSubject
     * @return Activities
     */
    public function setGroupSubject(\Teaching\GeneralBundle\Entity\GroupsSubjects $groupSubject = null)
    {
        $this->groupSubject = $groupSubject;
    
        return $this;
    }

    /**
     * Get groupSubject
     *
     * @return \Teaching\GeneralBundle\Entity\Groups 
     */
    public function getGroupSubject()
    {
        return $this->groupSubject;
    }
}
