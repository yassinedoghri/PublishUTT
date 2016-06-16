<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity
 */
class Author {

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
     * @ORM\Column(name="firstname", type="string", length=64, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=64, nullable=true)
     */
    private $lastname;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PublicationAuthor", mappedBy="author")
     */
    private $publications;

    /**
     * Constructor
     */
    public function __construct() {
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Author
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Author
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Add publications
     *
     * @param \AppBundle\Entity\PublicationAuthor $publications
     * @return Author
     */
    public function addPublication(\AppBundle\Entity\PublicationAuthor $publications) {
        $this->publications[] = $publications;

        return $this;
    }

    /**
     * Remove publications
     *
     * @param \AppBundle\Entity\PublicationAuthor $publications
     */
    public function removePublication(\AppBundle\Entity\PublicationAuthor $publications) {
        $this->publications->removeElement($publications);
    }

    /**
     * Get publications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPublications() {
        return $this->publications;
    }

}
