<?php


namespace App\Traits;


use App\Models\Settings;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

trait SeoHelper
{
    public function setIndexSeo(){
        $title = Settings::where('key' , 'meta_title')->pluck('value')->first() ?:'' ;
        $name = Settings::where('key' , 'name')->pluck('value')->first() ?:'' ;
        $shortActivity = Settings::where('key' , 'meta_desc')->pluck('value')->first() ?:'' ;
        $keyword = Settings::where('key' , 'meta_keyword')->pluck('value')->first() ?: [] ;
        if ($keyword){
            $keywordFinal = explode(',' , $keyword) ;
        }else{
            $keywordFinal = [];
        }
        $urlSite = Settings::where('key' , 'address')->pluck('value')->first() ?:'' ;
        $logoSite = Settings::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        SEOTools::setDescription($shortActivity);
        SEOTools::opengraph()->setUrl($urlSite);
        SEOTools::setCanonical($urlSite);
        SEOMeta::addKeyword($keywordFinal);
        SEOTools::opengraph()->addProperty('type', 'store');
        //twitter
        SEOTools::twitter()->setSite($title);
        SEOTools::twitter()->setDescription($shortActivity);
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setImage($urlSite . $logoSite);
        SEOTools::twitter()->addValue('image:alt' , $title);
        SEOTools::twitter()->addValue('card' , 'summary');
        SEOTools::jsonLd()->addImage($urlSite . $logoSite);
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($shortActivity);
        SEOTools::jsonLd()->setType('WebSite');
        SEOTools::jsonLd()->addValues([
            'url' => $urlSite,
            'potentialAction' => [
                '@type' => "SearchAction",
                'target' => $urlSite."search?search={search}",
                'query-input' => "required name=search"
            ]
        ]);
        //OpenGraph
        OpenGraph::addProperty('locale', 'fa');
        OpenGraph::setSiteName($name);
        OpenGraph::addImage($urlSite . $logoSite);
        OpenGraph::setTitle($title); // define title
        OpenGraph::setDescription($shortActivity);  // define description
        OpenGraph::setUrl($urlSite); // define url

        JsonLd::setTitle($title);
        JsonLd::setDescription($shortActivity);
        JsonLd::setType('store');
        JsonLd::addImage($urlSite . $logoSite);

        JsonLdMulti::setTitle($title);
        JsonLdMulti::setDescription($shortActivity);
        JsonLdMulti::setType('store');
        JsonLdMulti::addImage($urlSite . $logoSite);
    }

    public function seoSingleSeo($title , $description , $type , $url , $image,$keyword){
        $titleSite = Settings::where('key' , 'meta_title')->pluck('value')->first() ?:'' ;
        $urlSite = Settings::where('key' , 'address')->pluck('value')->first() ?:'' ;
        if ($keyword){
            $keywordFinal = explode(',' , $keyword) ;
        }else{
            $keywordFinal = [];
        }
        $name = Settings::where('key' , 'name')->pluck('value')->first() ?:'' ;
        SEOTools::opengraph()->setUrl($urlSite .  $url);
        SEOTools::setCanonical($urlSite .  $url);
        SEOTools::setDescription($description);
        SEOMeta::addKeyword($keywordFinal);
        SEOTools::opengraph()->addProperty('type', 'WebSite');
        //twitter
        SEOTools::twitter()->setSite($titleSite);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setTitle($title);
        SEOTools::jsonLd()->addImage($urlSite . $image);
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->setType('WebSite');
        SEOTools::twitter()->setImage($urlSite . $image);
        //OpenGraph
        OpenGraph::addProperty('locale', 'fa');
        OpenGraph::setSiteName($name);
        OpenGraph::addImage($urlSite . $image);
        OpenGraph::setTitle($title); // define title
        OpenGraph::setDescription($description);  // define description
        OpenGraph::setUrl($urlSite .  $url); // define url

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('store');
        JsonLd::addImage($urlSite . $image);

        JsonLdMulti::setTitle($title);
        JsonLdMulti::setDescription($description);
        JsonLdMulti::setType('store');
        JsonLdMulti::addImage($urlSite . $image);
    }
}
