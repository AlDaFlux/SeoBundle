<?php

namespace Aldaflux\Bundle\SeoBundle\Tests\Seo\Twitter;

use Aldaflux\Bundle\SeoBundle\Builder\TagBuilder;
use Aldaflux\Bundle\SeoBundle\Factory\TagFactory;
use Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoGenerator;
use Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoConfigurator;
use Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;
use Aldaflux\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of TwitterSeoConfiguratorTest.
 *
 * @author: leogout
 */
class TwitterSeoConfiguratorTest extends TestCase
{
    /**
     * @var TwitterSeoGenerator
     */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
    }

    /**
     * @expectedException \Aldaflux\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException
     * @expectedExceptionMessage Invalid seo generator passed to Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoConfigurator. Expected "Aldaflux\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator", but got "Aldaflux\Bundle\SeoBundle\Seo\Og\OgSeoGenerator".
     */
    public function testException()
    {
        $invalidGenerator = new OgSeoGenerator(new TagBuilder(new TagFactory()));
        $configurator = new TwitterSeoConfigurator([]);
        $configurator->configure($invalidGenerator);
    }

    public function testTitle()
    {
        $config = [
            'title' => 'Awesome | Site'
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:title" content="Awesome | Site" />',
            $this->generator->render()
        );
    }

    public function testDescription()
    {
        $config = [
            'description' => 'My awesome site is so cool!',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );
    }

    public function testImage()
    {
        $config = [
            'image' => 'http://images.com/poney/12',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:image" content="http://images.com/poney/12" />',
            $this->generator->render()
        );
    }

    public function testCard()
    {
        $config = [
            'card' => 'summary',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:card" content="summary" />',
            $this->generator->render()
        );
    }

    public function testSite()
    {
        $config = [
            'site' => '@leogoutt',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:site" content="@leogoutt" />',
            $this->generator->render()
        );
    }

    public function testNoConfig()
    {
        $config = [];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '',
            $this->generator->render()
        );
    }
}
