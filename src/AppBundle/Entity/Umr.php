<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Umr
 *
 * @ORM\Table(name="umr")
 * @ORM\Entity
 */
class Umr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=10, nullable=true)
     */
    private $initials;

    /**
     * @var string
     *
     * @ORM\Column(name="wording", type="string", length=64, nullable=true)
     */
    private $wording;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrganizationUmr", mappedBy="umr")
     */
    private $organizations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Team", mappedBy="umr")
     */
    private $teams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->organizations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set initials
     *
     * @param string $initials
     * @return Umr
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials
     *
     * @return string 
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Set wording
     *
     * @param string $wording
     * @return Umr
     */
    public function setWording($wording)
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * Get wording
     *
     * @return string 
     */
    public function getWording()
    {
        return $this->wording;
    }

    /**
     * Add organizations
     *
     * @param \AppBundle\Entity\OrganizationUmr $organizations
     * @return Umr
     */
    public function addOrganization(\AppBundle\Entity\OrganizationUmr $organizations)
    {
        $this->organizations[] = $organizations;

        return $this;
    }

    /**
     * Remove organizations
     *
     * @param \AppBundle\Entity\OrganizationUmr $organizations
     */
    public function removeOrganization(\AppBundle\Entity\OrganizationUmr $organizations)
    {
        $this->organizations->removeElement($organizations);
    }

    /**
     * Get organizations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }

    /**
     * Add teams
     *
     * @param \AppBundle\Entity\Team $teams
     * @return Umr
     */
    public function addTeam(\AppBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \AppBundle\Entity\Team $teams
     */
    public function removeTeam(\AppBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
