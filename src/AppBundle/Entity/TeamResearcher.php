<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamResearcher
 *
 * @ORM\Table(name="team_researcher", indexes={@ORM\Index(name="fk_team_researcher_user", columns={"id_researcher"})})
 * @ORM\Entity
 */
class TeamResearcher
{
    /**
     * @var \AppBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="researchers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_team", referencedColumnName="id")
     * })
     */
    private $team;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_researcher", referencedColumnName="id")
     * })
     */
    private $researcher;



    /**
     * Set team
     *
     * @param \AppBundle\Entity\Team $team
     * @return TeamResearcher
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set researcher
     *
     * @param \AppBundle\Entity\User $researcher
     * @return TeamResearcher
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
