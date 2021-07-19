<?php

namespace Aldaflux\Bundle\SeoBundle\Seo;

use Aldaflux\Bundle\SeoBundle\Builder\TagBuilder;
use Aldaflux\Bundle\SeoBundle\Model\RenderableInterface;

/**
 * Description of AbstractSeoGenerator.
 *
 * @author: leogout
 */
abstract class AbstractSeoGenerator implements RenderableInterface
{
    /**
     * @var TagBuilder
     */
    protected $tagBuilder;

    /**
     * BasicSeoBuilder constructor.
     *
     * @param TagBuilder $tagBuilder
     */
    public function __construct(TagBuilder $tagBuilder)
    {
        $this->tagBuilder = $tagBuilder;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->tagBuilder->render();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
