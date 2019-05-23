<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\EventController;

use App\Facades\Cronos;
use App\Facades\Str;
use Goutte\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\DomCrawler\Crawler;

class AllController extends EventController
{

  private $eventToTreat = [
        "id_event" => null,
        "country" => null,
        "region" => null,
        "postal_code" => null,
        "location_name" => null,
        "street_complete" => null,
        "venue_name" => null,
        "event_category" => null,
        "event_type" => null,
        "event_title" => null,
        "event_subtitle" => null,
        "event_intro" => null,
        "event_description" => null,
        "credits" => null,
        "has_parent" => null,
        "has_children" => null,
        "price" => null,
        "date" => null,
        "date_start" => null,
        "date_end" => null,
        "promoter" => null,
        "partners" => null,
        "additional_info" => null,
        "opening_hours" => null,
        "languages" => null,
        "img_thumb" => null,
        "img_gallery" => null,
        "video_gallery" => null,
        "kids_friendly" => null,
        "for_kids" => null,
        "status" => null
    ];

  private $eventCalendarToTreat = [];

  public function allCategories(Request $request, Response $response)
   {
          $urls = [
              "https://www.visitberlin.de/en/category/lecture",
              "https://www.visitberlin.de/en/category/art",
              "https://www.visitberlin.de/en/category/play",
              "https://www.visitberlin.de/en/category/shows-musicals",
              "https://www.visitberlin.de/en/category/exhibitions",
              "https://www.visitberlin.de/en/category/puppet-theatre",
              "https://www.visitberlin.de/en/category/architecture-design",
              "https://www.visitberlin.de/en/category/photography",
              "https://www.visitberlin.de/en/category/history"
           
    ];



  //   self::createEvent($urls);

   }


  public function createEvent($urls)
  {

        

    // config crawler
    $config = [ 'verify' => false, ];
    $client = new Client;
    $client->setClient(new \GuzzleHttp\Client($config));
    $url_root = "https://www.visitberlin.de";


    foreach (range(1,1) as $page) 
    {

        foreach ($urls as $url)  
        {

           dump($url);
           $config = [ 'verify' => false, ];
           $client = new Client;
           $client->setClient(new \GuzzleHttp\Client($config));

           $crawler = $client->request('GET', $url); 


           $crawler->filter("li.l-list__item")->each(function 
              ($event) {

                        // GET LINK TO EACH EVENT
                        //$articleuri = $event->attributes["about"]->value;
                        $articleuri = $event->filter('article.teaser-search')->hmtl();

                        dump($articleuri);

                        // ON EVENT PAGE
                        // set new crawler
                        
                        $client->setClient(new \GuzzleHttp\Client(['verify' => false]));

                        $articlecrawler = $crawler = $client->request('GET', $url_root.$articleuri);

                        // self::fillEvent($this->eventToTreat, $this->eventCalendarToTreat, $articlecrawler);
                        sleep(4);

                

            });//end crawler

              

      }//end crawler
          
         

  }//nuevo foreach



        

  }// end function

        //parent::event( array ($eventToFill, $eventCalendarToFill) );
        // parent::show(); // show results
        //parent::insertToDB();
	

}// end class

