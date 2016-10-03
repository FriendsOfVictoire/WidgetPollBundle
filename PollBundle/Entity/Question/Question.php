<?php

namespace Victoire\Widget\PollBundle\Entity\Question;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Answer\Answer;
use Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;

/**
 * Question.
 *
 * @ORM\Table("vic_widget_poll_question")
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
class Question
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
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Answer", mappedBy="question")
     */
    private $answers;

    /**
     * @var SurveyQuestion
     * @ORM\OneToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion", mappedBy="question")
     */
    private $surveyQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=2)
     */
    private $locale;

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
     * Set title.
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
     * Get title.
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
     * Constructor.
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer.
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
     * Remove answer.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Answer $answer
     */
    public function removeAnswer(\Victoire\Widget\PollBundle\Entity\Answer\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return SurveyQuestion
     */
    public function getSurveyQuestion()
    {
        return $this->surveyQuestion;
    }

    /**
     * @param SurveyQuestion $surveyQuestion
     */
    public function setSurveyQuestion($surveyQuestion)
    {
        $this->surveyQuestion = $surveyQuestion;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
