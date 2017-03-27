<?php

namespace App\Routing;

abstract class Route
{
    /**
     * Route Container
     */
    protected static $routes;


	/**
	 * Returns all routes
	 *
	 * @return Array 
	 */
	public static function all()
	{
		return self::$routes;
	}


	/**
	 * Defines a GET route
	 *
	 * @param string $route
	 * @param string $callback
	 */
	public static function get($route, $callback)
	{
		self::add('GET', $route, $callback);
	}


	/**
	 * Defines a POST route
	 *
	 * @param string $route
	 * @param string $callback
	 */
	public static function post($route, $callback)
	{
		self::add('POST', $route, $callback);
	}


    /**
     * Defines the route structure
     *
     * @param string $route
     * @param string $callback
     */
    private static function add($method, $route, $callback)
    {
        self::$routes[] = [
            'METHOD' => $method,
            'ROUTE' => $route,
            'CALLBACK' => $callback,
        ];
    }
}