<?php

namespace App\Facades;

use App\Facades\Abstracts\Facade;

class Math extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'math';
	}
}