<?php

namespace Victoire\Widget\PollBundle\Entity\Survey;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag.
 *
 * @ORM\Table("vic_widget_poll_survey_tag")
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var SurveyQuestion[]
     * @ORM\ManyToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion", mappedBy="tags")
     */
    private $questions;

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
     * Set name.
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion $question
     *
     * @return Tag
     */
    public function addQuestion(\Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion $question
     */
    public function removeQuestion(\Victoire\Widget\PollBundle\Entity\Survey\SurveyQuestion $question)
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
}
