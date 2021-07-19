<?php

namespace Aldaflux\Bundle\SeoBundle\Tests\Seo\Og;

use Aldaflux\Bundle\SeoBundle\Builder\TagBuilder;
use Aldaflux\Bundle\SeoBundle\Factory\TagFactory;
use Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoConfigurator;
use Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoGenerator;
use Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;
use Aldaflux\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of OgSeoConfiguratorTest.
 *
 * @author: leogout
 */
class OgSeoConfiguratorTest extends TestCase
{
    /**
     * @var OgSeoGenerator
     */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new OgSeoGenerator(new TagBuilder(new TagFactory()));
    }

    /**
     * @expectedException \Aldaflux\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException
     * @expectedExceptionMessage Invalid seo generator passed to Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoConfigurator. Expected "Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoGenerator", but got "Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator".
     */
    public function testException()
    {
        $invalidGenerator = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
        $configurator = new OgSeoConfigurator([]);
        $configurator->configure($invalidGenerator);
    }

    public function testTitle()
    {
        $config = [
            'title' => 'Awesome | Site'
        ];

        $configurator = new OgSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta property="og:title" content="Awesome | Site" />',
            $this->generator->render()
        );
    }

    public function testDescription()
    {
        $config = [
            'description' => 'My awesome site is so cool!',
        ];

        $configurator = new OgSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta property="og:description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );
    }

    public function testImage()
    {
        $config = [
            'image' => 'http://images.com/poney/12',
        ];

        $configurator = new OgSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta property="og:image" content="http://images.com/poney/12" />',
            $this->generator->render()
        );
    }

    public function testType()
    {
        $config = [
            'type' => 'website',
        ];

        $configurator = new OgSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta property="og:type" content="website" />',
            $this->generator->render()
        );
    }

    public function testNoConfig()
    {
        $config = [];

        $configurator = new OgSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '',
            $this->generator->render()
        );
    }
}
