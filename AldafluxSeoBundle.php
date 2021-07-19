<?php

namespace Aldaflux\Bundle\SeoBundle;

use Aldaflux\Bundle\SeoBundle\DependencyInjection\Compiler\SeoGeneratorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AldafluxSeoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SeoGeneratorPass());
    }
}
