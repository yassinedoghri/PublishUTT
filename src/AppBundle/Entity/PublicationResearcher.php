<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationResearcher
 *
 * @ORM\Table(name="publication_researcher", indexes={@ORM\Index(name="fk_publication_researcher_user", columns={"id_researcher"})})
 * @ORM\Entity
 */
class PublicationResearcher
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="owner", type="boolean", nullable=true)
     */
    private $owner;

    /**
     * @var integer
     *
     * @ORM\Column(name="orderIndex", type="integer", nullable=true)
     */
    private $orderindex;

    /**
     * @var \AppBundle\Entity\Publication
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication", inversedBy="researchers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication", referencedColumnName="id")
     * })
     */
    private $publication;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="researchers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_researcher", referencedColumnName="id")
     * })
     */
    private $researcher;



    /**
     * Set owner
     *
     * @param boolean $owner
     * @return PublicationResearcher
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return boolean 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set orderindex
     *
     * @param integer $orderindex
     * @return PublicationResearcher
     */
    public function setOrderindex($orderindex)
    {
        $this->orderindex = $orderindex;

        return $this;
    }

    /**
     * Get orderindex
     *
     * @return integer 
     */
    public function getOrderindex()
    {
        return $this->orderindex;
    }

    /**
     * Set publication
     *
     * @param \AppBundle\Entity\Publication $publication
     * @return PublicationResearcher
     */
    public function setPublication(\AppBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \AppBundle\Entity\Publication 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set researcher
     *
     * @param \AppBundle\Entity\User $researcher
     * @return PublicationResearcher
     */
    public function setResearcher(\AppBundle\Entity\User $researcher = null)
    {
        $this->researcher = $researcher;

        return $this;
    }

    /**
     * Get researcher
     *
     * @return \AppBundle\Entity\User 
     */
    public function getResearcher()
    {
        return $this->researcher;
    }
}
