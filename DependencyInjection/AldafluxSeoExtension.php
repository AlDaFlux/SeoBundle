<?php

namespace Aldaflux\Bundle\SeoBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Description of AldafluxSeoExtension.
 *
 */
class AldafluxSeoExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $this->loadIfConfigured('basic', $container, $loader, $config);
        $this->loadIfConfigured('og', $container, $loader, $config);
        $this->loadIfConfigured('twitter', $container, $loader, $config);

        $loader->load('services.xml');
    }

    /**
     * Checks if the configuration with this name isn't empty.
     * Creates a parameter and loads a configuration file of the given configuration name.
     *
     * @param string $configName
     * @param ContainerBuilder $container
     * @param XmlFileLoader $loader
     * @param array $config
     */
    private function loadIfConfigured($configName, ContainerBuilder $container, XmlFileLoader $loader, array $config)
    {
        if (!isset($config[$configName])) {
            return;
        }
        $config = array_merge($config['general'], $config[$configName]);
        $container->setParameter(
            sprintf('aldaflux_seo.%s', $configName),
            $config
        );
        $loader->load(sprintf('seo/%s.xml', $configName));
    }
}
