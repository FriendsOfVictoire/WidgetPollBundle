<?php

namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Question\Proposal;

/**
 * Radio
 *
 * @ORM\Entity
 */
class Radio extends Question
{
    /**
     * @var Proposal []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Proposal", mappedBy="question", cascade={"persist"})
     */
    private $proposals;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'radio';
    }

    /**
     * Add proposal
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal
     *
     * @return Radio
     */
    public function addProposal(\Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal)
    {
        $this->proposals[] = $proposal;
        $proposal->setQuestion($this);
        return $this;
    }

    /**
     * Remove proposal
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal
     */
    public function removeProposal(\Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal)
    {
        $this->proposals->removeElement($proposal);
    }

    /**
     * Get proposals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }
}
