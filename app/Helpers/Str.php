<?php

namespace App\Helpers;

class Str
{

	public function toUpper($string) 
	{
		return mb_strtoupper($string, 'UTF-8');
	}

    public function friendlyUrl($string)
    {
        //Convert accented characters, and remove parentheses and apostrophes
        $from = explode(',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
        $to   = explode(',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,');
        //Do the replacements, and convert all other non-alphanumeric characters to spaces
        $string = preg_replace('~[^A-Za-z0-9]+~', '-', str_replace($from, $to, trim($string)));
        //Remove a - at the beginning or end and make lowercase
        return strtolower(preg_replace('/^-/', '', preg_replace('/-$/', '', $string)));
    }

    public function removeHttp($string) {
		$string = preg_replace('#^https?://#', '', $string);
		return $string;
	}

    public function strim($string)
    {
        return trim(preg_replace('/\s+/', ' ', $string));
    }

}