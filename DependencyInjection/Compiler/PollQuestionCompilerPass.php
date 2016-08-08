<?php

namespace Victoire\Widget\PollBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PollQuestionCompilerPass implements CompilerPassInterface
{
    /**
     * Process filter.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('victoire.widget.poll.poll_question_chain')) {
            $definition = $container->getDefinition(
                'victoire.widget.poll.poll_question_chain'
            );

            $taggedServices = $container->findTaggedServiceIds(
                'victoire_widget_poll.question'
            );

            foreach ($taggedServices as $id => $tags) {
                foreach ($tags as $attributes) {
                    $definition->addMethodCall('addPollQuestion', [
                            new Reference($id),
                            $attributes['questionType'],
                        ]
                    );
                }
            }
        }
    }
}
