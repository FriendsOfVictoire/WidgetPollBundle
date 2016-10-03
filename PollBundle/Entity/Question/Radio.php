<?php

namespace Victoire\Widget\PollBundle\Entity\Question;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radio.
 *
 * @ORM\Entity
 */
class Radio extends Question
{
    /**
     * @var Proposal []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Proposal", mappedBy="question", cascade={"persist", "remove"})
     */
    private $proposals;
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add proposal.
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
     * Remove proposal.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal
     */
    public function removeProposal(\Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal)
    {
        $this->proposals->removeElement($proposal);
        $proposal->setQuestion(null);
    }

    /**
     * Get proposals.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }
}
