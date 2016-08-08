<?php
namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Victoire\Bundle\WidgetBundle\Entity\Widget;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * WidgetPoll
 *
 * @ORM\Table("vic_widget_poll")
 * @ORM\Entity
 */
class WidgetPoll extends Widget
{


    /**
     * @var Question []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Question", mappedBy="widget", cascade={"persist"})
     */
    private $questions;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $secure;

    public function __construct()
    {
        parent::__construct();
        $this->questions = new ArrayCollection();
    }

    /**
     * To String function
     * Used in render choices type (Especially in VictoireWidgetRenderBundle)
     * //TODO Check the generated value and make it more consistent
     *
     * @return String
     */
    public function __toString()
    {
        return 'Poll #'.$this->id;
    }

    /**
     * Add question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Question $question
     *
     * @return WidgetPoll
     */
    public function addQuestion(\Victoire\Widget\PollBundle\Entity\Question\Question $question)
    {
        $this->questions[] = $question;
        $question->setWidget($this);

        return $this;
    }

    /**
     * Remove question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Question $question
     */
    public function removeQuestion(\Victoire\Widget\PollBundle\Entity\Question\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @return boolean
     */
    public function isSecure()
    {
        return $this->secure;
    }
    
    /**
     * @param boolean $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }
}
