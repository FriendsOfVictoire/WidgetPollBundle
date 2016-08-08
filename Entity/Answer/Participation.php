<?php

namespace Victoire\Widget\PollBundle\Entity\Answer;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Voting;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;

/**
 * Poll
 *
 * @ORM\Table("vic_widget_poll_participation")
 * @ORM\Entity(repositoryClass="Victoire\Widget\PollBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var integer 
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var WidgetPoll
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\WidgetPoll")
     */
    private $widgetPoll;

    /**
     * @var Answer[]
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Answer", mappedBy="poll", cascade={"persist", "remove"})
     */
    private $answers;

    /**
     * @var Voting
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Voting", inversedBy="polls")
     */
    private $voting;

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
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set widgetPoll
     *
     * @param \Victoire\Widget\PollBundle\Entity\WidgetPoll $widgetPoll
     *
     * @return Poll
     */
    public function setWidgetPoll(\Victoire\Widget\PollBundle\Entity\WidgetPoll $widgetPoll = null)
    {
        $this->widgetPoll = $widgetPoll;

        return $this;
    }

    /**
     * Get widgetPoll
     *
     * @return \Victoire\Widget\PollBundle\Entity\WidgetPoll
     */
    public function getWidgetPoll()
    {
        return $this->widgetPoll;
    }

    /**
     * Add answer
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Answer $answer
     *
     * @return Poll
     */
    public function addAnswer(\Victoire\Widget\PollBundle\Entity\Answer\Answer $answer)
    {
        $this->answers[] = $answer;
        $answer->setPoll($this);

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Answer $answer
     */
    public function removeAnswer(\Victoire\Widget\PollBundle\Entity\Answer\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set voting
     *
     * @param \Victoire\Widget\PollBundle\Entity\Voting $voting
     *
     * @return Participation
     */
    public function setVoting(\Victoire\Widget\PollBundle\Entity\Voting $voting = null)
    {
        $this->voting = $voting;

        return $this;
    }

    /**
     * Get voting
     *
     * @return \Victoire\Widget\PollBundle\Entity\Voting
     */
    public function getVoting()
    {
        return $this->voting;
    }
}
