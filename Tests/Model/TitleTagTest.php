<?php

namespace Aldaflux\Bundle\SeoBundle\Tests\Model;

use Aldaflux\Bundle\SeoBundle\Model\TitleTag;
use Aldaflux\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of TitleTagTest.
 *
 * @author: leogout
 */
class TitleTagTest extends TestCase
{
    public function testRender()
    {
        $titleTag = new TitleTag();
        $titleTag->setContent('Awesonme | Site');

        $this->assertEquals(
            '<title>Awesonme | Site</title>',
            $titleTag->render()
        );
    }

    public function testRenderTitleOnly()
    {
        $titleTag = new TitleTag();
        $titleTag
            ->setContent('Site');

        $this->assertEquals(
            '<title>Site</title>',
            $titleTag->render()
        );
    }

    public function testRenderNothing()
    {
        $titleTag = new TitleTag();

        $this->assertEquals(
            '<title></title>',
            $titleTag->render()
        );
    }
}
