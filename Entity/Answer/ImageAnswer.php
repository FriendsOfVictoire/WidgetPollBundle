<?php

namespace Victoire\Widget\PollBundle\Entity\Answer;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Widget\PollBundle\Entity\Question\Image;

/**
 * ImageAnswer
 *
 * @ORM\Entity
 */
class ImageAnswer extends Answer
{
    /**
     * @var Image
     * @ORM\ManyToOne(targetEntity="Victoire\Widget\PollBundle\Entity\Question\Image", inversedBy="answers")
     */
    private $image;

    /**
     * Set image
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question\Image $image
     *
     * @return ImageAnswer
     */
    public function setImage(\Victoire\Widget\PollBundle\Entity\Question\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Victoire\Widget\PollBundle\Entity\Question\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
