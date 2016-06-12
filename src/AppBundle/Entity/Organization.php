<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table(name="organization")
 * @ORM\Entity
 */
class Organization
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrganizationUmr", mappedBy="organization")
     */
    private $umrs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->umrs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Organization
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
     * @return Organization
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
     * Add umrs
     *
     * @param \AppBundle\Entity\OrganizationUmr $umrs
     * @return Organization
     */
    public function addUmr(\AppBundle\Entity\OrganizationUmr $umrs)
    {
        $this->umrs[] = $umrs;

        return $this;
    }

    /**
     * Remove umrs
     *
     * @param \AppBundle\Entity\OrganizationUmr $umrs
     */
    public function removeUmr(\AppBundle\Entity\OrganizationUmr $umrs)
    {
        $this->umrs->removeElement($umrs);
    }

    /**
     * Get umrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUmrs()
    {
        return $this->umrs;
    }
}
