<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Facades\Cronos;
use App\Facades\Str;
use Goutte\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\DomCrawler\Crawler;

function startsWith($haystack, $needle)
{
$length = strlen($needle);
return (substr($haystack, 0, $length) === $needle);
}

class ConferenceController extends Controller
{

  	public function conference (Request $request, Response $response)
  	{



  		// delete all events beginning with 'conc_'
                  // $delete_concerts = "DELETE FROM `agenda.brussels_bxl` WHERE `id_event` LIKE 'b_conc_%'";
                  // $del = $this->db->prepare($delete_concerts);
                  // $del->execute();



          // start scraping

  		   
          $url_array = array(

            "https://www.visitberlin.de/en/category/lecture",
            // "https://www.visitberlin.de/en/category/art",
            // "https://www.visitberlin.de/en/category/play",
            // "https://www.visitberlin.de/en/category/shows-musicals"
            // "https://www.visitberlin.de/en/category/exhibitions",
            // "https://www.visitberlin.de/en/category/puppet-theatre",
            // "https://www.visitberlin.de/en/category/architecture-design",
            // "https://www.visitberlin.de/en/category/photography",
            // "https://www.visitberlin.de/en/category/history",

          );

          $url_root = "https://www.visitberlin.de";


          foreach ($url_array as $url)  
          {
            
            $id_count = 0; 
            $id_event = "";
            
            $config = [
                          'verify' => false
                      ];

            $client = new Client();

    
            $client->setClient(new \GuzzleHttp\Client($config));
             
              

            $crawler = $client->request('GET', $url);
                
            $listitems = $crawler->filter("ul.l-list > li.l-list__item > article");

            //dump($listitems);

           



            //

            // if ($crawler->filter('a.category-label') && $crawler->filter('div.teaser__paid')) { // if this two classes exist

            //     $event_category = NULL;

            // }elseif ($event_category = $crawler->filter('a.category-label')->text()) { // else just take category label
                
              
            //     if ($event_category ==='Lecture') {

            //               $event_category = 'Conference';

            //           }else 
            //           {

            //            $event_category;
            //           }

            // }



              // This code works!

             // if ($event_category ==='Lecture') {

             //    $event_category = 'Conference';

             // }elseif (stripos($event_category = $crawler->filter('span.paid')->text(), 'Advertisement') !== false) {
             //    $event_category = NULL;
             // }else {

             //      $event_category;
             // }

             //print($event_category);


                                


            foreach($listitems as $item)  {
              
              //dump($item);

              $id_count++;
              $id_event = "ber_id_". $id_count;

              dump($id_event);

               // //category

              $addresses = $item-> getElementsByTagName('a');

              foreach ($addresses as $category => $address) {
                if ($address->getAttribute('class') === 'category-label') {
                  $event_category = $address->textContent ;
                }
                elseif ($address->getAttribute('class') === 'heading-highlight__inner') {
                  $articleuri = $address->getAttribute('href');
                }
              }


              if (!startsWith($articleuri, 'https://www.berlin.de/.bin/fwd.fcgi')) {

                $articlecrawler = $client->request('GET', $url_root.$articleuri);

                if ($articlecrawler) {

                                  $country = "Germany";
                                  $region = "Berlin";
                                  $event_type = "";
                                  $event_subtitle = "";
                                  $event_intro = "";
                                  $event_description = "";
                                  $credits ="";
                                  $has_parent = "";
                                  $has_children = "";
                                  $price = "";
                                  $date_start ="";
                                  $date_end = "";
                                  $promoter = "";
                                  $partners = "";
                                  $opening_hours = "";
                                  $languages = "";
                                  $img_gallery = "";
                                  $video_gallery = "";
                                  $kids_friendly = "";
                                  $for_kids = "";
                                  $status = "";
                                  $calendar = "";


                                  //postal code

                                  //$postal_code = $articlecrawler->filter('p > span.address__zip')-> text();

                                  //region

                                 // $location_name = $articlecrawler->filter('p > span.address__city')-> text();

                                  //Street

                                 // $street = $articlecrawler->filter('p > span.address__row')-> text();

                                 //  //venue_name

                                 // $venue_name = $articlecrawler->filter('h3.map-slider-item__heading > span.heading-highlight__inner')-> text();


                                 //  //title
                
                                   //$title = $articlecrawler->filter('h1.content-node__heading')->text();
                                  
                                  // print($title);

                                  // // event subtitle

                                 //  if ($articlecrawler->filter('p.content-node__subheading')->count() > 0) {
                                 //    $event_subtitle = $articlecrawler->filter('p.content-node__subheading')->text();
                                 //  }

                                 //  //dump($event_subtitle);

                                
                                 // //event_intro

                                 //  if ($articlecrawler->filter('p.lead')->count() > 0) {

                                 //    $event_intro = $articlecrawler->filter('p.lead')->text();
                                     
                                 //  }

                                   //dump($event_intro);

                                    //event description (no working!)

                                  // if ($articlecrawler->filter('div.content-node__description')->count() > 0) {
                                  //    $event_description = $articlecrawler->filter('div.content-node__description > div')->eq(3)->text();
                                  // }

                                  // dump($event_description);

                                 //$description = $articlecrawler->filter('p.lead')->text();

                                 //  //date
                                 //  $date_first = $articlecrawler->filter('time.heading-highlight__inner')->text();

                                 //  $date_before = strtr($date_first, '/', '-');

                                 //  $date = date("Y-m-d", strtotime($date_before)); //get good date format.

                                 //  //dump($date);

                                 //  // additional info

                                 //  $additional_info = $articlecrawler->filter('ul.arrowlist')->text();

                                 //  //dump($additional_info); 
                                 

                                 // // price

                                  if ($articlecrawler->filter('aside.content-node__aside > div')->count() > 0) {

                                      if ($beforeprices = str_replace('Additional information','', $articlecrawler->filter('aside.content-node__aside')->text() ) === 'We do apologize that the following information is currently only available in German.') {

                                         $price;

                                      }elseif ($beforeprices = str_replace('Additional information','', $articlecrawler->filter('aside.content-node__aside')->text() ) !== 'We do apologize that the following information is currently only available in German.') {

                                         $beforeprices = str_replace('Additional information','', $articlecrawler->filter('aside.content-node__aside')->text());
                                         $price = $beforeprices;
                                        

                                       }//elseif ($articlecrawler->filter('div.content-node__description')->count() > 0) {

                                      //   $price = $articlecrawler->filter('div.content-node__description > div')->eq(3)->text(); // free admision text not working!
                                        
                                      // }
                                  
                                      } elseif ($articlecrawler->filter('aside.content-node__aside')->count() == 0 ) {

                                          $hrefprices = $articlecrawler->filter('a.button--booking')->attr('href');

                                          $price = 'For more info about tickets please go to:  '. $hrefprices; // I need to clean the href here!
                                      }else{
                                    $price;
                                  }

                                 //dump($price);

                                  

                                  //image 
                                //   $img = $articlecrawler->filter('img.bleed-header__img')->attr('src');

                                //     $test = $articlecrawler->filter('figure.bleed-header__figure > picture')->html();

                                //    dump($test);


                                //   if (strpos($articlecrawler->filter('figure.bleed-header__figure')->html(), 'source') !== false)     
                                //   {
                                //      $img_thumb = "No esta Vacio";

                                //    } else $img_thumb = NULL; // me sigue dando el error de que el nodulo esta vacio.
                                    

                                //   $img_thumb = $url_root. $img;

                                //   print($img_thumb);

                                             
                                // $img = $articlecrawler->filter('img.bleed-header__img')->attr('src');



                                  $results[] = 
                                  [
                                      'id' => $id_event,
                                      'country' => $country,
                                      'region' => $region,
                                      'postal_code' => $postal_code,
                                      'location_name' => $location_name,
                                      'street_complete' => $street,
                                      'venue_name' => $venue_name,
                                      'event_category' => $event_category,
                                      'event_type' => $event_type,
                                      'title' => $title,
                                      'event_subtitle' => $event_subtitle,
                                      'event_intro' => $event_intro,
                                      'event_description' => $description,
                                      'credits' => $credits,
                                      'has_parent' => $has_parent,
                                      'has_children' => $has_children,
                                      'price' => $prices,
                                      'date' => $date,
                                      'date_start' => $date_start,
                                      'date_end' => $date_end,
                                      'promoter' => $promoter,
                                      'partners' => $partners,
                                      'additional_info' => $additional_info,
                                      'opening_hours' => $opening_hours,
                                      'languages' => $languages,
                                      'img_thumb' => $img_thumb,
                                      'img_gallery' => $img_gallery,
                                      'video_gallery' => $video_gallery,
                                      'kids_friendly' => $kids_friendly,
                                      'for_kids' => $for_kids,
                                      'status' => $status,
                                      'calendar' => $calendar
                                  ];
                
              } 
                
              }//crawler end 



               
            }//foreach end   
             //dump($results);  

          }//foreach end 

  	
    }//function end

}

?>