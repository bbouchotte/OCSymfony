<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * AdvertSkill
 *
 * @ORM\Table(name="advert_skill")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertSkillRepository")
 */
class Advert_Skill
{

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Advert", inversedBy="advert_skills")
	 * @JoinColumn(name="advert_id", referencedColumnName="id")
	 */
	private $advert;
	
	/**
	 * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Skill", inversedBy="advert_skills")
	 * @JoinColumn(name="skill_id", referencedColumnName="id")
	 */
	private $skill;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="level", type="string", length=255)
	 */
	private $level;


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
	 * Set level
	 *
	 * @param string $level
	 *
	 * @return AdvertSkill
	 */
	public function setLevel($level)
	{
		$this->level = $level;

		return $this;
	}

	/**
	 * Get level
	 *
	 * @return string
	 */
	public function getLevel()
	{
		return $this->level;
	}

	 

    /**
     * Set advert
     *
     * @param \OC\PlatformBundle\Entity\Advert $advert
     *
     * @return Advert_Skill
     */
    public function setAdvert(\OC\PlatformBundle\Entity\Advert $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \OC\PlatformBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set skill
     *
     * @param \OC\PlatformBundle\Entity\Skill $skill
     *
     * @return Advert_Skill
     */
    public function setSkill(\OC\PlatformBundle\Entity\Skill $skill = null)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \OC\PlatformBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
