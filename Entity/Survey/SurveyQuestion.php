<?php

namespace Victoire\Widget\PollBundle\Entity\Survey;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\BusinessEntityBundle\Entity\Traits\BusinessEntityTrait;
use Victoire\Bundle\CoreBundle\Annotations as VIC;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * SurveyQuestion.
 *
 * @ORM\Table("vic_widget_poll_survey_question")
 * @VIC\BusinessEntity({"Poll"})
 * @ORM\Entity
 */
class SurveyQuestion
{
    use BusinessEntityTrait;
    /**
     * @var int
     *
     * @VIC\BusinessProperty("businessParameter")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Question
     * @ORM\OneToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Question", inversedBy="surveyQuestion", cascade={"persist", "remove"})
     */
    private $question;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var Tag[]
     * @ORM\ManyToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Survey\Tag", inversedBy="questions", cascade={"persist"})
     */
    private $tags;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function __toString()
    {
        return sprintf('SurveyQuestion #%s', $this->id);
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
     * Set question.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Question $question
     *
     * @return SurveyQuestion
     */
    public function setQuestion(\Victoire\Widget\PollBundle\Entity\Question\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add tag.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Survey\Tag $tag
     *
     * @return SurveyQuestion
     */
    public function addTag(\Victoire\Widget\PollBundle\Entity\Survey\Tag $tag)
    {
        $this->tags[] = $tag;
        $tag->addQuestion($this);

        return $this;
    }

    /**
     * Remove tag.
     *
     * @param \Victoire\Widget\PollBundle\Entity\Survey\Tag $tag
     */
    public function removeTag(\Victoire\Widget\PollBundle\Entity\Survey\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set enabled.
     *
     * @param bool $enabled
     *
     * @return SurveyQuestion
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled.
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
