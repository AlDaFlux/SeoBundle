<?php

namespace Aldaflux\Bundle\SeoBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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
  
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $fields=['title','description','image','url','keywords','twitter'];
        
        
        foreach ($fields as $field)
        {
            $container->setParameter($field, "");
        }
        
        foreach ($fields as $field)
        {
            if (isset($config[$field]) && $config[$field])
            {
                $container->setParameter($field, $config[$field]);
            }
        }
        
        $loader->load('services.yml');
        
    }

}
