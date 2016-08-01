<?php
namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\WidgetBundle\Entity\Widget;

/**
 * WidgetPoll
 *
 * @ORM\Table("vic_widget_poll")
 * @ORM\Entity
 */
class WidgetPoll extends Widget
{

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


}
