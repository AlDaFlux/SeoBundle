<?php

namespace Aldaflux\Bundle\SeoBundle\Twig;
 

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Aldaflux\Bundle\SeoBundle\Service\SeoService;

/**
 * Description of SeoExtension.
 *
 * @author: leogout
 */
class SeoExtension extends AbstractExtension
{
    /**
     * @var SeoGeneratorProvider
     */
    protected $generatorProvider;

    /**
     * SeoExtension constructor.
     *
     * @param SeoGeneratorProvider $generatorProvider
     */
    public function __construct( SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('aldaflux_seo', [$this->seoService, 'renderMeta'], ['is_safe' => ['html']]),
        );
    }
 

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'aldaflux_seo.twig.seo_extension';
    }
}
