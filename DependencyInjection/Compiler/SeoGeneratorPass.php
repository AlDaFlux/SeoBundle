<?php

namespace Aldaflux\Bundle\SeoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of SeoGeneratorPass.
 *
 */
class SeoGeneratorPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('aldaflux_seo.provider.generator');
        $taggedServices = $container->findTaggedServiceIds('aldaflux_seo.generator');

        foreach ($taggedServices as $id => $tags) {
            $generatorDefinition = $container->getDefinition($id);
            if (!$generatorDefinition->isPublic()) {
                throw new \InvalidArgumentException(sprintf('Seo generator services must be public, but "%s" is not.', $id));
            }
            if ($generatorDefinition->isAbstract()) {
                throw new \InvalidArgumentException(sprintf('Seo generator services cannot be abstract but "%s" is.', $id));
            }
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new \InvalidArgumentException(sprintf('Tag "aldaflux_seo.generator" requires an "alias" field in "%s" definition.', $id));
                }

                $definition->addMethodCall('set', [$attributes['alias'], new Reference($id)]);
            }
        }
    }
}
