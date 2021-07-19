<?php

namespace Aldaflux\Bundle\SeoBundle\Tests\Seo\Basic;

use Aldaflux\Bundle\SeoBundle\Builder\TagBuilder;
use Aldaflux\Bundle\SeoBundle\Factory\TagFactory;
use Aldaflux\Bundle\SeoBundle\Provider\SeoGeneratorProvider;
use Aldaflux\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Aldaflux\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of SeoGeneratorProviderTest.
 *
 * @author: leogout
 */
class SeoGeneratorProviderTest extends TestCase
{
    /**
     * @var SeoGeneratorProvider
     */
    protected $provider;

    protected function setUp()
    {
        $tagBuilder = new TagBuilder(new TagFactory());
        $basicGenerator = new BasicSeoGenerator($tagBuilder);

        $this->provider = new SeoGeneratorProvider();

        $this->provider->set('basic', $basicGenerator);
    }

    public function testGetGenerator()
    {
        $this->assertInstanceOf(
            BasicSeoGenerator::class,
            $this->provider->get('basic')
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The SEO generator with alias "undefined" is not defined.
     */
    public function testGetUndefinedGenerator()
    {
        $this->provider->get('undefined');
    }

    public function testGetAllGenerators()
    {
        $this->assertInstanceOf(
            BasicSeoGenerator::class,
            $this->provider->getAll()['basic']
        );
    }

    /**
     * @param
     */
    public function testHasGenerator()
    {
        $this->assertTrue(
            $this->provider->has('basic')
        );
        $this->assertFalse(
            $this->provider->has('undefined')
        );
    }
}
