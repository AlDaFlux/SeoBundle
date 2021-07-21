<?php

namespace Aldaflux\Bundle\SeoBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SeoService
{
    private $title;
    private $description;
    private $url;
    private $article;
    private $image;
    private $twitter;
    private $card;
  
    
    public function __construct(ParameterBagInterface $parameters,RequestStack $requestStack)
    {
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
    
    
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;
        return $this;
    }
    
    
    
    
    
    /*asic','og','twitter'];
            foreach ($seoTypes as $seoType)
            {
                $this->seo->get($seoType)->setTitle($title);
                $this->seo->get($seoType)->setDescription($description);
            }
            $this->seo->get("og")->setUrl("http://dev.nouvelleaquitaine.handidonnees.fr/page/allocataires-handicapes/allocataires-aeeh-enfants");
            $this->seo->get("og")->setType("article");
            $this->seo->get("og")->setImage($this->assetsManager->getUrl('build/img/logo1.png'));
            $this->seo->get("twitter")->s*/
    
    
    
    public function renderMeta()
    {
        $retour_general='';
        $retour_facebook='';
        $retour_twitter='';
        
        if ($this->getTitle())
        {
            $retour_general.='<meta name="title" "'.$this->getTitle().'" />'."\n";
            $retour_facebook.='<meta name="og:title" "'.$this->getTitle().'" />'."\n";
            $retour_twitter.='<meta name="twitter:title" "'.$this->getTitle().'" />'."\n";
        }
        
        if ($this->getDescription())
        {
            $retour_general.='<meta name="description" "'.$this->getDescription().'" />'."\n";
            $retour_facebook.='<meta name="og:description" "'.$this->getDescription().'" />'."\n";
            $retour_twitter.='<meta name="twitter:description" "'.$this->getDescription().'" />'."\n";
        }
        
        if ($this->getImage())
        {
            $retour_facebook.='<meta name="og:image" "'.$this->getImage().'" />'."\n";
            $retour_twitter.='<meta name="twitter:image" "'.$this->getImage().'" />'."\n";
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
