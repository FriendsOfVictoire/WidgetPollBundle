<?php

namespace Victoire\Widget\PollBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class VictoireWidgetPollExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $file = __DIR__.'/../Resources/config/config_poll.yml';
        array_unshift($configs, Yaml::parse(file_get_contents($file))['victoire_widget_poll']);
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $this->saveWidgetPollConfiguration($container, $config);

        $container->setParameter(
            'victoire_widget_poll.victoire_menu_item', false
        );
    }
    private function saveWidgetPollConfiguration(ContainerBuilder $container, $config)
    {
        if ($container->hasDefinition('victoire.widget.poll.poll_configuration_chain')) {
            $definition = $container->getDefinition(
                'victoire.widget.poll.poll_configuration_chain'
            );

            foreach ($config as $alias => $formConfiguration) {
                $definition->addMethodCall('addPollconfiguration', [
                        $alias,
                        $formConfiguration
                    ]
                );
            }

        }
    }

}
