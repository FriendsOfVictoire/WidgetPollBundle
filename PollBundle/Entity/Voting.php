<?php

namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Answer\Participation;

/**
 * Voting.
 *
 * @ORM\Table("vic_widget_poll_voting")
 * @ORM\Entity
 */
class Voting
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $user;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $userIp;

    /**
     * @var Participation []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Participation", mappedBy="voting")
     */
    private $participations;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userIp.
     *
     * @param string $userIp
     *
     * @return Voting
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp.
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set user.
     *
     *
     * @return Voting
     */
    public function setUser($user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Victoire\Bundle\UserBundle\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->participations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add poll.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Participation $participation
     *
     * @return Voting
     */
    public function addParticipation(\Victoire\Widget\PollBundle\Entity\Answer\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Participation $participation
     */
    public function removeParticipation(\Victoire\Widget\PollBundle\Entity\Answer\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get polls.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }
}
