<?php

namespace Victoire\Widget\PollBundle\Entity\Answer;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * Answer
 *
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"default" = "Answer", "radio" = "RadioAnswer"})
 * @ORM\Table("vic_widget_poll_answer")
 * @ORM\Entity
 */
class Answer
{
    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Question", inversedBy="answers")
     */
    private $question;

    /**
     * @var Participation
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Participation", inversedBy="answers")
     */
    private $participation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Question $question
     *
     * @return Answer
     */
    public function setQuestion(\Victoire\Widget\PollBundle\Entity\Question\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set participation
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Participation $participation
     *
     * @return Answer
     */
    public function setParticipation(\Victoire\Widget\PollBundle\Entity\Answer\Participation $participation = null)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return \Victoire\Widget\PollBundle\Entity\Answer\Participation
     */
    public function getParticipation()
    {
        return $this->participation;
    }
}
