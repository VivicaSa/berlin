<?php

namespace App\Facades;

use App\Facades\Abstracts\Facade;

class Cronos extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'cronos';
	}
}