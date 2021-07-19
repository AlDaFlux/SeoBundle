<?php

namespace Aldaflux\Bundle\SeoBundle\Factory;

use Aldaflux\Bundle\SeoBundle\Model\LinkTag;
use Aldaflux\Bundle\SeoBundle\Model\MetaTag;
use Aldaflux\Bundle\SeoBundle\Model\TitleTag;

/**
 * Description of TagFactory.
 *
 * @author: leogout
 */
class TagFactory
{
    /**
     * @return TitleTag
     */
    public function createTitle()
    {
        $titleTag = new TitleTag();

        return $titleTag;
    }

    /**
     * @return MetaTag
     */
    public function createMeta()
    {
        $metaTag = new MetaTag();

        return $metaTag;
    }

    /**
     * @return LinkTag
     */
    public function createLink()
    {
        $linkTag = new LinkTag();

        return $linkTag;
    }
}
