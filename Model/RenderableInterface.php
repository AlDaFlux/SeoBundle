<?php

namespace Aldaflux\Bundle\SeoBundle\Model;

/**
 * Description of MetaTagInterface.
 *
 * @author: leogout
 */
interface RenderableInterface
{
    /**
     * @return string
     */
    public function render();

    /**
     * @return string
     */
    public function __toString();
}
