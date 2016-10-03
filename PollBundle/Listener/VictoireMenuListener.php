<?php

namespace Victoire\Widget\PollBundle\Listener;

use Knp\Menu\ItemInterface;
use Victoire\Bundle\CoreBundle\Menu\MenuBuilder;

class VictoireMenuListener
{
    private $menuBuilder;
    private $victoireMenuItem;

    /**
     * {@inheritdoc}
     */
    public function __construct(MenuBuilder $menuBuilder, $victoireMenuItem)
    {
        $this->menuBuilder = $menuBuilder;
        $this->victoireMenuItem = $victoireMenuItem;
    }

    /**
     * Add a menu item for Participation stats.
     *
     * @return ItemInterface
     */
    public function addGlobal()
    {
        $mainItem = $this->menuBuilder->getTopNavbar();

        if ($this->victoireMenuItem) {
            $mainItem->addChild(
                'Sondages',
                [
                    'route' => 'vic_widget_poll_results',
                ]
            )->setLinkAttribute('data-toggle', 'vic-modal');
        }

        return $mainItem;
    }
}
