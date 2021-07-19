<?php

namespace Aldaflux\Bundle\SeoBundle\Seo\Og;

use Aldaflux\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Aldaflux\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Aldaflux\Bundle\SeoBundle\Seo\ImageSeoInterface;

/**
 * Description of OgSeoInterface.
 *
 * @author: leogout
 */
interface OgSeoInterface extends TitleSeoInterface, DescriptionSeoInterface, ImageSeoInterface
{
}
