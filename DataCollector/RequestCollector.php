<?php

namespace Aldaflux\Bundle\SeoBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
 
 

use Aldaflux\Bundle\SeoBundle\Service\SeoService;

        

class RequestCollector extends DataCollector implements DataCollectorInterface
{
    private $seo;
    protected $title;
    
    public function __construct(SeoService $seoService) 
    {
        $this->seo=$seoService;
    }
    
    
    public function collect(Request $request, Response $response,? \Throwable $exception  = null)
    {
     
         
     $this->data = [
            'method' => $request->getMethod(),
            'acceptable_content_types' => $request->getAcceptableContentTypes(),
            'seo' =>  $this->seo,
            'title' =>  $this->seo->GetTitle(), 
            'description' =>  $this->seo->getDescription(),
            'image' =>  $this->seo->getImage(),
            'twitter' =>  $this->seo->getTwitter(),
            'nbMetas' =>  $this->seo->nbMetas()
        ];
    }

    public function reset()
    {
        $this->data = [];
    }
   
    public function getNbMetas()
    {
         return $this->data['nbMetas'];
    }
    public function getTitle()
    {
         return $this->data['title'];
    }
    
    public function getTwitter()
    {
         return $this->data['twitter'];
    }
    
    public function getDescription()
    {
         return $this->data['description'];;
    }
    
    public function getImage()
    {
         return $this->data['image'];;
    }
    
    
    public function getName()
    {
        return 'aldaflux_seo.request_collector';
    }

    
    public static function getTemplate(): ?string
    {
        return '@AldafluxSeo/Collector/collector.html.twig';
    }
 
    
    
   
     
}