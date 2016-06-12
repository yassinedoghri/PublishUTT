<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team", indexes={@ORM\Index(name="fk_team_umr", columns={"umr"})})
 * @ORM\Entity
 */
class Team
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
     * @ORM\Column(name="wording", type="string", length=128, nullable=true)
     */
    private $wording;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamResearcher", mappedBy="team")
     */
    private $researchers;

    /**
     * @var \AppBundle\Entity\Umr
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Umr", inversedBy="teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="umr", referencedColumnName="id")
     * })
     */
    private $umr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->researchers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Team
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
     * @return Team
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
     * Add researchers
     *
     * @param \AppBundle\Entity\TeamResearcher $researchers
     * @return Team
     */
    public function addResearcher(\AppBundle\Entity\TeamResearcher $researchers)
    {
        $this->researchers[] = $researchers;

        return $this;
    }

    /**
     * Remove researchers
     *
     * @param \AppBundle\Entity\TeamResearcher $researchers
     */
    public function removeResearcher(\AppBundle\Entity\TeamResearcher $researchers)
    {
        $this->researchers->removeElement($researchers);
    }

    /**
     * Get researchers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResearchers()
    {
        return $this->researchers;
    }

    /**
     * Set umr
     *
     * @param \AppBundle\Entity\Umr $umr
     * @return Team
     */
    public function setUmr(\AppBundle\Entity\Umr $umr = null)
    {
        $this->umr = $umr;

        return $this;
    }

    /**
     * Get umr
     *
     * @return \AppBundle\Entity\Umr 
     */
    public function getUmr()
    {
        return $this->umr;
    }
}
