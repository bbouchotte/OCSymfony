<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\SkillRepository")
 */
class Skill
{
	public function __construct()
	{
		$this->advert_skills = new ArrayCollection();
	}
	
	/**
	 * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Advert_Skill", mappedBy="skill", cascade={"remove"})
	 */
	private $advert_skills;
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skill
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
     * Add advertSkill
     *
     * @param \OC\PlatformBundle\Entity\Advert_Skill $advertSkill
     *
     * @return Skill
     */
    public function addAdvertSkill(\OC\PlatformBundle\Entity\Advert_Skill $advertSkill)
    {
        $this->advert_skills[] = $advertSkill;

        return $this;
    }

    /**
     * Remove advertSkill
     *
     * @param \OC\PlatformBundle\Entity\Advert_Skill $advertSkill
     */
    public function removeAdvertSkill(\OC\PlatformBundle\Entity\Advert_Skill $advertSkill)
    {
        $this->advert_skills->removeElement($advertSkill);
    }

    /**
     * Get advertSkills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertSkills()
    {
        return $this->advert_skills;
    }
}
