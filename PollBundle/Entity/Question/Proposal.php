<?php

namespace Victoire\Widget\PollBundle\Entity\Question;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Answer\RadioAnswer;

/**
 * Proposal.
 *
 * @ORM\Table("vic_widget_poll_proposal")
 * @ORM\Entity
 */
class Proposal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $value;

    /**
     * @var Radio
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Radio", inversedBy="proposals")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $question;

    /**
     * @var RadioAnswer[]
     *
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\RadioAnswer", mappedBy="proposal")
     */
    private $answers;

    /**
     * Proposal constructor.
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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
     * Set value.
     *
     * @param string $value
     *
     * @return Proposal
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set question.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Radio $question
     *
     * @return Proposal
     */
    public function setQuestion(\Victoire\Widget\PollBundle\Entity\Question\Radio $question = null)
    {
        $this->question = $question;
        foreach ($this->answers as $answer) {
            $answer->setQuestion($question);
        }

        return $this;
    }

    /**
     * Get question.
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\Radio
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return RadioAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
