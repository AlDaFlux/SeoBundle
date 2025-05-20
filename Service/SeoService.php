<?php

namespace Aldaflux\Bundle\SeoBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Asset\Packages;
        
class SeoService
{
    private $title;
    private $params;
    
    protected $assetsManager;
    protected $urlHelper;
    
    private $description;
    private $url;
    private $article;
    private $image;
    private $twitter;
    private $card;
  
    
    public function __construct(ParameterBagInterface $parameters,RequestStack $requestStack,UrlHelper $urlHelper, Packages $assetsManager)
    {
        $this->urlHelper=$urlHelper;
        $this->assetsManager=$assetsManager;
        
        $this->title = $parameters->Get("title");
        $this->description = $parameters->Get("description");
        $request = $requestStack->getCurrentRequest();
        if ($request)
        {
            $this->url = $request->getUri();
        }
        
        $this->image = $parameters->Get("image");
        $this->twitter = $parameters->Get("twitter");
        $this->article = "article";
    }
    
    function nbMetas()
    {
        $nb=0;
        if ($this->getTitle()) {$nb++;}
        if ($this->getDescription()) {$nb++;}
        if ($this->getImage()) {$nb++;}
        return($nb);
    }
   
    
    public function setTitle(?string $title)
    {
        $this->title=$title;
    }
    
    public function getTitle(): ?string
    {
        return ($this->title);
    }
    
 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    

        
        
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }
    
    
    public function setImageFromAsset(?string $image)
    {
          $this->image = $this->urlHelper->getAbsoluteUrl($this->assetsManager->getUrl($image));
    }
    
    
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;
        return $this;
    }
    
    public function renderMeta()
    {
        $retour_general='';
        $retour_facebook='';
        $retour_twitter='';
        
        if ($this->getTitle())
        {
            $retour_general.='<meta name="title" content="'.$this->getTitle().'" />'."\n";
            $retour_facebook.='<meta name="og:title" content="'.$this->getTitle().'" />'."\n";
            $retour_twitter.='<meta name="twitter:title" content="'.$this->getTitle().'" />'."\n";
        }
        
        if ($this->getDescription())
        {
            $retour_general.='<meta name="description" content="'.$this->getDescription().'" />'."\n";
            $retour_facebook.='<meta name="og:description" content="'.$this->getDescription().'" />'."\n";
            $retour_twitter.='<meta name="twitter:description" content="'.$this->getDescription().'" />'."\n";
        }
        
        if ($this->getImage())
        {
            $retour_facebook.='<meta name="og:image" content="'.$this->getImage().'" />'."\n";
            $retour_twitter.='<meta name="twitter:image" content="'.$this->getImage().'" />'."\n";
            $retour_twitter.='<meta name="twitter:card" content="summary" />'."\n";
        }
        
        if ($this->getTwitter())
        {
            $retour_twitter.='<meta name="twitter:site" content="'.$this->getTwitter().'" />'."\n";
        }
        
        
        $seoBlock="og";
        $seoFields="og";
        
        return($retour_general.$retour_facebook.$retour_twitter);
    }
     
    
    
    //$this->apiKey = $params->get("youtube_api_key");
     
     
}
