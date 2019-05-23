<?php

namespace App\Facades;

use App\Facades\Abstracts\Facade;

class Str extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'str';
	}
}