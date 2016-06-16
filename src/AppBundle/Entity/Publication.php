<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Publication
 *
 * @ORM\Table(name="publication", indexes={@ORM\Index(name="fk_publication_publisher", columns={"publisher"}), @ORM\Index(name="fk_publication_category", columns={"category"})})
 * @ORM\Entity
 */
class Publication {

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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="booktitle", type="string", length=128, nullable=true)
     */
    private $booktitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfPublication", type="date", nullable=true)
     */
    private $dateofpublication;

    /**
     * @var string
     *
     * @ORM\Column(name="journal", type="string", length=128, nullable=true)
     */
    private $journal;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="string", length=1000, nullable=true)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="string", length=32, nullable=true)
     */
    private $volume;

    /**
     * @var string
     *
     * @ORM\Column(name="pages", type="string", length=10, nullable=true)
     */
    private $pages;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=128, nullable=true)
     */
    private $location;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     * @Assert\Choice(choices = {"P", "R", "S"}, message = "Choose a valid status.")
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PublicationResearcher", mappedBy="publication")
     */
    private $researchers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PublicationAuthor", mappedBy="publication")
     */
    private $authors;

    /**
     * @var \AppBundle\Entity\Publisher
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publisher", inversedBy="publications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="publisher", referencedColumnName="id")
     * })
     */
    private $publisher;

    /**
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="initials")
     * })
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct() {
        $this->researchers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Publication
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set booktitle
     *
     * @param string $booktitle
     * @return Publication
     */
    public function setBooktitle($booktitle) {
        $this->booktitle = $booktitle;

        return $this;
    }

    /**
     * Get booktitle
     *
     * @return string 
     */
    public function getBooktitle() {
        return $this->booktitle;
    }

    /**
     * Set dateofpublication
     *
     * @param \Date $dateofpublication
     * @return Publication
     */
    public function setDateofpublication($dateofpublication) {
        $this->dateofpublication = $dateofpublication;

        return $this;
    }

    /**
     * Get dateofpublication
     *
     * @return \DateTime 
     */
    public function getDateofpublication() {
        return $this->dateofpublication;
    }

    /**
     * Set journal
     *
     * @param string $journal
     * @return Publication
     */
    public function setJournal($journal) {
        $this->journal = $journal;

        return $this;
    }

    /**
     * Get journal
     *
     * @return string 
     */
    public function getJournal() {
        return $this->journal;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Publication
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Publication
     */
    public function setAbstract($abstract) {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract() {
        return $this->abstract;
    }

    /**
     * Set volume
     *
     * @param string $volume
     * @return Publication
     */
    public function setVolume($volume) {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return string 
     */
    public function getVolume() {
        return $this->volume;
    }

    /**
     * Set pages
     *
     * @param string $pages
     * @return Publication
     */
    public function setPages($pages) {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return string 
     */
    public function getPages() {
        return $this->pages;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Publication
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Publication
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Add researchers
     *
     * @param \AppBundle\Entity\PublicationResearcher $researchers
     * @return Publication
     */
    public function addResearcher(\AppBundle\Entity\PublicationResearcher $researchers) {
        $this->researchers[] = $researchers;

        return $this;
    }

    /**
     * Remove researchers
     *
     * @param \AppBundle\Entity\PublicationResearcher $researchers
     */
    public function removeResearcher(\AppBundle\Entity\PublicationResearcher $researchers) {
        $this->researchers->removeElement($researchers);
    }

    /**
     * Get researchers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResearchers() {
        return $this->researchers;
    }

    /**
     * Add authors
     *
     * @param \AppBundle\Entity\PublicationAuthor $authors
     * @return Publication
     */
    public function addAuthor(\AppBundle\Entity\PublicationAuthor $authors) {
        $this->authors[] = $authors;

        return $this;
    }

    /**
     * Remove authors
     *
     * @param \AppBundle\Entity\PublicationAuthor $authors
     */
    public function removeAuthor(\AppBundle\Entity\PublicationAuthor $authors) {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors() {
        return $this->authors;
    }

    /**
     * Set publisher
     *
     * @param \AppBundle\Entity\Publisher $publisher
     * @return Publication
     */
    public function setPublisher(\AppBundle\Entity\Publisher $publisher = null) {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \AppBundle\Entity\Publisher 
     */
    public function getPublisher() {
        return $this->publisher;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Publication
     */
    public function setCategory(\AppBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory() {
        return $this->category;
    }

}
