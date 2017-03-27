<?php

namespace App\Routing;

require __DIR__.'/../routes.php';

$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
$uri = explode('/', $_SERVER['REQUEST_URI']);

foreach($scriptName as $index => $part){
	if($part == $uri[$index]) unset($uri[$index]);
}

$uri = implode('/', $uri);
$uri = explode('?', $uri);

// let's omit the query string and also variables for now
foreach(Route::all() as $key => $route) {
    if(
        $route['METHOD'] == $_SERVER['REQUEST_METHOD']
        && $route['ROUTE'] == $uri[0]
    ) {
        $callback = explode('@', $route['CALLBACK']);

        // for brevity I will omit the callable check
        $class = 'App\Controllers\\'.$callback[0];
        $method = $callback[1];
        
        // for brevity I am ignoring variables in the routes hence the verbosity here
        if(strpos($uri[0], '1')) $response = (new $class)->$method(1);
        else if(strpos($uri[0], '2')) $response = (new $class)->$method(2);
        else if(strpos($uri[0], '3')) $response = (new $class)->$method(3);
        else $response = (new $class)->$method();

        echo $response;
        return;
    }
}

// no routes found
throw new \Exception('No Route found ');