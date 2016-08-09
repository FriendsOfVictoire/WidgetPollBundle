<?php

namespace Victoire\Widget\PollBundle\Entity\Question;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposal
 *
 * @ORM\Entity
 */
class ImageChooser extends Question
{

    /**
     * @var Image []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Image", mappedBy="question", cascade={"persist"})
     */
    private $images;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Image $image
     *
     * @return ImageChooser
     */
    public function addImage(\Victoire\Widget\PollBundle\Entity\Question\Image $image)
    {
        $this->images[] = $image;
        $image->setQuestion($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Image $image
     */
    public function removeImage(\Victoire\Widget\PollBundle\Entity\Question\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
