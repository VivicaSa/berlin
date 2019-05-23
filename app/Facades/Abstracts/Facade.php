<?php

namespace App\Facades\Abstracts;

abstract class Facade
{
	
	protected static $container;

	protected static $resolved;

	public static function setContainer($container)
	{
		static::$container = $container;
	}

	
	public static function getFacadeInstance()
	{
		$accessor = static::getFacadeAccessor();

		// if ($resolved = static::$resolved[$accessor]) {
		// 	return $resolved;
		// }
		
		return static::$resolved[$accessor] = static::$container[$accessor];
	}

	
	public static function __callStatic($method, $args)
	{
		$instance = static::getFacadeInstance();
		return $instance->$method(...$args);
	}

}
