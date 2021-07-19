<?php

namespace Aldaflux\Bundle\SeoBundle\Seo\Basic;

use Aldaflux\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException;
use Aldaflux\Bundle\SeoBundle\Seo\AbstractSeoConfigurator;
use Aldaflux\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

/**
 * Description of BasicSeoConfigurator.
 *
 * @author: leogout
 */
class BasicSeoConfigurator extends AbstractSeoConfigurator
{
    /**
     * @param AbstractSeoGenerator $generator
     */
    public function configure(AbstractSeoGenerator $generator)
    {
        if (!($generator instanceof BasicSeoGenerator)) {
            throw new InvalidSeoGeneratorException(__CLASS__, BasicSeoGenerator::class, get_class($generator));
        }
        if (null !== $title = $this->getConfig('title')) {
            $generator->setTitle($title);
        }
        if (null !== $description = $this->getConfig('description')) {
            $generator->setDescription($description);
        }
        if (null !== $keywords = $this->getConfig('keywords')) {
            $generator->setKeywords($keywords);
        }
        if (null !== $robots = $this->getConfig('robots')) {
            $generator->setRobots($robots['index'], $robots['follow']);
        }
        if (null !== $canonical = $this->getConfig('canonical')) {
            $generator->setCanonical($canonical);
        }
    }
}
