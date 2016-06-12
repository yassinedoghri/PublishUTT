<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizationUmr
 *
 * @ORM\Table(name="organization_umr", indexes={@ORM\Index(name="fk_organization_umr_umr", columns={"id_umr"})})
 * @ORM\Entity
 */
class OrganizationUmr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_organization", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idOrganization;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_umr", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUmr;

    /**
     * @var \AppBundle\Entity\Organization
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organization", inversedBy="umrs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_organization", referencedColumnName="id")
     * })
     */
    private $organization;

    /**
     * @var \AppBundle\Entity\Umr
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Umr", inversedBy="organizations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_umr", referencedColumnName="id")
     * })
     */
    private $umr;



    /**
     * Set idOrganization
     *
     * @param integer $idOrganization
     * @return OrganizationUmr
     */
    public function setIdOrganization($idOrganization)
    {
        $this->idOrganization = $idOrganization;

        return $this;
    }

    /**
     * Get idOrganization
     *
     * @return integer 
     */
    public function getIdOrganization()
    {
        return $this->idOrganization;
    }

    /**
     * Set idUmr
     *
     * @param integer $idUmr
     * @return OrganizationUmr
     */
    public function setIdUmr($idUmr)
    {
        $this->idUmr = $idUmr;

        return $this;
    }

    /**
     * Get idUmr
     *
     * @return integer 
     */
    public function getIdUmr()
    {
        return $this->idUmr;
    }

    /**
     * Set organization
     *
     * @param \AppBundle\Entity\Organization $organization
     * @return OrganizationUmr
     */
    public function setOrganization(\AppBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \AppBundle\Entity\Organization 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set umr
     *
     * @param \AppBundle\Entity\Umr $umr
     * @return OrganizationUmr
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
