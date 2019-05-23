<?php

namespace App\Helpers;

class Cronos
{

    /**
    * Convert 'jeudi 15 janvier 2019' to 2019-01-15.
    *
    * @param string
    *
    * @return string
    */
	public function mediumDate($date) 
	{
        $idf = new \IntlDateFormatter('fr_Fr', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
        $idf->setPattern('eeee dd MMMM yyyy');
        $tstp = $idf->parse($date);
        $dt = (new \DateTime())->setTimestamp($tstp);
        return  $dt->format('Y-m-d');
	}

    /**
    * Convert '15 févr 2019' to 2019-02-15.
    *
    * @param string
    *
    * @return string
    */
    public function longDate($date) 
    {
        $idf = new \IntlDateFormatter('fr_Fr', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
        $idf->setPattern('dd MMM yyyy');
        $tstp = $idf->parse($date);
        $dt = (new \DateTime())->setTimestamp($tstp);
        return  $dt->format('Y-m-d');
    }

}