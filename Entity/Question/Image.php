<?php

namespace Victoire\Widget\PollBundle\Entity\Question;



use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer;
use Victoire\Widget\PollBundle\Entity\Question\Question;

/**
 * Image
 *
 * @ORM\Entity
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="Victoire\Bundle\MediaBundle\Entity\Media")
     */
    private $value;

    /**
     * @var Radio
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\ImageChooser", inversedBy="images")
     */
    private $question;

    /**
     * @var ImageAnswer[]
     *
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer", mappedBy="image")
     */
    private $answers;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set value
     *
     * @param \Victoire\Bundle\MediaBundle\Entity\Media $value
     *
     * @return Image
     */
    public function setValue(\Victoire\Bundle\MediaBundle\Entity\Media $value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return \Victoire\Bundle\MediaBundle\Entity\Media
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\ImageChooser $question
     *
     * @return Image
     */
    public function setQuestion(\Victoire\Widget\PollBundle\Entity\Question\ImageChooser $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\ImageChooser
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add answer
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer $answer
     *
     * @return Image
     */
    public function addAnswer(\Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer $answer
     */
    public function removeAnswer(\Victoire\Widget\PollBundle\Entity\Answer\ImageAnswer $answer)
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
