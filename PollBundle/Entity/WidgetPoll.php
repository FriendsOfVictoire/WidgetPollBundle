<?php

namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\WidgetBundle\Entity\Widget;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * WidgetPoll.
 *
 * @ORM\Table("vic_widget_poll")
 * @ORM\Entity
 */
class WidgetPoll extends Widget
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var Question []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Question", mappedBy="widget", cascade={"persist"})
     */
    private $questions;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $secure = true;

    public function __construct()
    {
        parent::__construct();
        $this->questions = new ArrayCollection();
    }

    /**
     * To String function
     * Used in render choices type (Especially in VictoireWidgetRenderBundle)
     * //TODO Check the generated value and make it more consistent.
     *
     * @return string
     */
    public function __toString()
    {
        return 'Poll #'.$this->id;
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
     * Add question.
     *
     * @param Question $question
     *
     * @return WidgetPoll
     */
    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
        $question->setWidget($this);

        return $this;
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;
        /** @var Question $question */
        foreach ($questions as $question) {
            $question->setWidget($this);
        }

        return $this;
    }

    /**
     * Remove question.
     *
     * @param Question $question
     */
    public function removeQuestion(Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }
}
