<?php       

    namespace App\Controllers;

    use App\Controllers\Controller;

    use App\Facades\Cronos;
    use App\Facades\Str;
    use Goutte\Client;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Symfony\Component\DomCrawler\Crawler;



    class Event extends Controller
    {
    private $data;
    private $event;
    private $calendar;


    public function event($data) {
    $this->data = $data;
    }

    public function show() {
    $this->event = $this->data[0];
    $this->calendar = $this->data[1];

    dump( $this->data );
    }


    public function insertToDB() {

    // insert event
    $insert_event = "INSERT IGNORE INTO `visit.berlin_agenda`(`id`, `country`, `region`, `postal_code`, `location_name`, `street_complete`, `venue_name`, `category`, `type`, `title`, `subtitle`, `intro`, `description`, `credits`, `has_parent`, `has_children`, `price`, `date`, `date_start`, `date_end`, `promoter`, `partners`, `additional_info`, `opening_hours`, `languages`, `img_thumb`, `img_gallery`, `video_gallery`, `kids_friendly`, `for_kids`, `status`) VALUES (:id, :country, :region, :postal_code, :location_name, :street_complete, :venue_name, :category, :type, :title, :subtitle, :intro, :description, :credits, :has_parent, :has_children, :price, :dates, :date_start, :date_end, :promoter, :partners, :additional_info, :opening_hours, :languages, :img_thumb, :img_gallery, :video_gallery, :kids_friendly, :for_kids, :status)";

    $sth = $this->db->prepare($insert_event);

        $sth->bindValue(':id', $this->event['id_event']) ;
        $sth->bindValue(':country', $this->event['country'] );
        $sth->bindValue(':region', $this->event['region'] );
        $sth->bindValue(':postal_code', $this->event['postal_code'] );
        $sth->bindValue(':location_name', $this->event['location_name'] );
        $sth->bindValue(':street_complete', $this->event['street_complete'] );
        $sth->bindValue(':venue_name', $this->event['venue_name'] );
        $sth->bindValue(':category', $this->event['event_category'] );
        $sth->bindValue(':type', $this->event['event_type']);
        $sth->bindValue(':title', $this->event['event_title'] );
        $sth->bindValue(':subtitle', $this->event['event_subtitle'] );
        $sth->bindValue(':intro', $this->event['event_intro'] );
        $sth->bindValue(':description', $this->event['event_description'] );
        $sth->bindValue(':credits', $this->event['credits'] );
        $sth->bindValue(':has_parent', $this->event['has_parent'] );
        $sth->bindValue(':has_children', $this->event['has_children'] );
        $sth->bindValue(':price', $this->event['price'] );
        $sth->bindValue(':dates', $this->event['date'] );
        $sth->bindValue(':date_start', $this->event['date_start'] );
        $sth->bindValue(':date_end', $this->event['date_end'] );
        $sth->bindValue(':promoter', $this->event['promoter'] );
        $sth->bindValue(':partners', $this->event['partners'] );
        $sth->bindValue(':additional_info', $this->event['additiponal_info'] );
        $sth->bindValue(':opening_hours', $this->event['opening_hours'] );
        $sth->bindValue(':languages', $this->event['languages'] );
        $sth->bindValue(':img_thumb', $this->event['img_thumb'] );
        $sth->bindValue(':img_gallery', $this->event['img_gallery'] );
        $sth->bindValue(':video_gallery', $this->event['video_gallery'] );
        $sth->bindValue(':kids_friendly', $this->event['kids_friendly'] );
        $sth->bindValue(':for_kids', $this->event['for_kids'] );
        $sth->bindValue(':status', $this->event['status'] );

    $sth->execute();

    // //insert calendar
    if ( count($this->calendar) != 0 ) {

        $insert_calendar = "INSERT INTO `hnt_nl_calendar`(`id`, `date`, `time_doors`, `time_start`, `time_end`, `venue_name`, `street_complete`, `postal_code`, `location_name`, `price`, `additional_infos`) VALUES ";


        foreach ($this->calendar as $clndr) {

            $clndr_string = '(';

            foreach ($clndr as $value) {

                if ($value == '') {
                    $value = 'null';
                }
                $clndr_string .= '"'.$value .'", ';   

            }

            $clndr_string .= '),'; 

        $clndr_string = str_replace(['"null"', ', ),'], ['null', '),'], $clndr_string );
        $insert_calendar .= $clndr_string;
        }

        $insert_calendar = substr($insert_calendar, 0, -1);

        $sth2 = $this->db->prepare($insert_calendar);
        $sth2->execute();
    }
    }

    }




    