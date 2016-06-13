<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationAuthor
 *
 * @ORM\Table(name="publication_author", indexes={@ORM\Index(name="fk_co_written_publication", columns={"id_publication"})})
 * @ORM\Entity
 */
class PublicationAuthor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="orderIndex", type="integer", nullable=true)
     */
    private $orderindex;

    /**
     * @var \AppBundle\Entity\Publication
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication", inversedBy="authors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_publication", referencedColumnName="id")
     * })
     */
    private $publication;

    /**
     * @var \AppBundle\Entity\Author
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Author", inversedBy="publications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_author", referencedColumnName="id")
     * })
     */
    private $author;



    /**
     * Set orderindex
     *
     * @param integer $orderindex
     * @return PublicationAuthor
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
     * @return PublicationAuthor
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
     * Set author
     *
     * @param \AppBundle\Entity\Author $author
     * @return PublicationAuthor
     */
    public function setAuthor(\AppBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
