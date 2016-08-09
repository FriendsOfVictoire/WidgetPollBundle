<?php

namespace Victoire\Widget\PollBundle\Entity\Answer;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Question\Proposal;

/**
 * RadioAnswer
 *
 * @ORM\Entity
 */
class RadioAnswer extends Answer
{
    /**
     * @var Proposal
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Proposal", inversedBy="answers")
     */
    private $proposal;

    /**
     * Set proposal
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal
     *
     * @return RadioAnswer
     */
    public function setProposal(\Victoire\Widget\PollBundle\Entity\Question\Proposal $proposal = null)
    {
        $this->proposal = $proposal;
        $this->setQuestion($proposal->getQuestion());

        return $this;
    }

    /**
     * Get proposal
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\Proposal
     */
    public function getProposal()
    {
        return $this->proposal;
    }
}
