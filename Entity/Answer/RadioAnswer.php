<?php

namespace Victoire\Widget\PollBundle\Entity\Answer;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Question\Proposal;

/**
 * RadioAnswer.
 *
 * @ORM\Entity
 */
class RadioAnswer extends Answer
{
    /**
     * @var Proposal
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Proposal", inversedBy="answers")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $proposal;

    /**
     * Set proposal.
     *
     * @param Proposal $proposal
     * @return RadioAnswer
     */
    public function setProposal(Proposal $proposal = null)
    {
        $this->proposal = $proposal;
        $this->setQuestion($proposal->getQuestion());

        return $this;
    }

    /**
     * Get proposal.
     *
     * @return Proposal
     */
    public function getProposal()
    {
        return $this->proposal;
    }
}
