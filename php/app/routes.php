<?php

namespace App\Routing;

// Define Routes here
Route::get('api/users', 'UserController@index');

// for brevity I am ignoring variables in the routes hence the verbosity here
Route::get('api/users/1', 'UserController@get');
Route::get('api/users/2', 'UserController@get');
Route::get('api/users/3', 'UserController@get');

// not implemented
Route::post('api/users', 'UserController@post');
