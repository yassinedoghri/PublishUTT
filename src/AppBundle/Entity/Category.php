<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category {

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=2)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Publication", mappedBy="category")
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get initials
     *
     * @return string 
     */
    public function getInitials() {
        return $this->initials;
    }

    /**
     * Set wording
     *
     * @param string $wording
     * @return Category
     */
    public function setWording($wording) {
        $this->wording = $wording;

        return $this;
    }

    /**
     * Get wording
     *
     * @return string 
     */
    public function getWording() {
        return $this->wording;
    }

    /**
     * Add categories
     *
     * @param \AppBundle\Entity\Publication $categories
     * @return Category
     */
    public function addCategory(\AppBundle\Entity\Publication $categories) {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \AppBundle\Entity\Publication $categories
     */
    public function removeCategory(\AppBundle\Entity\Publication $categories) {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Category toString
     *
     * @return string String representation of this class
     */
    public function __toString() {
        return $this->getInitials();
    }

}
