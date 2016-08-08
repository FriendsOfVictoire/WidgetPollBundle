<?php

namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Answer\Answer;

/**
 * Question
 *
 * @ORM\Table("vic_widget_poll_question")
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"default" = "Question", "radio" = "Radio"})
 */
class Question
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var WidgetPoll
     *
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\WidgetPoll", inversedBy="questions")
     */
    private $widget;

    /**
     * @var Answer[]
     *
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Answer", mappedBy="question")
     */
    private $answers;

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
     * @return string
     */
    public function getType()
    {
        return 'default';
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return WidgetPoll
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param WidgetPoll $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Answer $answer
     *
     * @return Question
     */
    public function addAnswer(\Victoire\Widget\PollBundle\Entity\Answer\Answer $answer)
    {
        $this->answers[] = $answer;
        $answer->setQuestion($this);

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
}
