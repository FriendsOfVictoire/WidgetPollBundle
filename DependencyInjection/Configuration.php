<?php

namespace Victoire\Widget\PollBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Victoire\Widget\PollBundle\Entity\Radio;
use Victoire\Widget\PollBundle\Form\Answer\RadioAnswerType;
use Victoire\Widget\PollBundle\Form\QuestionRadioType;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('victoire_widget_poll', 'array');
        $rootNode
            ->children()
            ->booleanNode('victoire_menu_item')
            ->defaultFalse()
            ->end()
            ->end()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->arrayNode('answer')
                        ->isRequired()
                        ->children()
                            ->scalarNode('entity')->isRequired()->end()
                            ->scalarNode('form')->isRequired()->end()
                            ->scalarNode('template')->isRequired()->end()
                        ->end()
                    ->end()
                    ->arrayNode('question')
                        ->isRequired()
                        ->children()
                            ->scalarNode('entity')->isRequired()->end()
                            ->scalarNode('form')->isRequired()->end()
                            ->scalarNode('template')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
