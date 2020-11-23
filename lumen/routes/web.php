<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');

    // Matches "/api/login
    $router->post('login', 'AuthController@authenticate');
});

$router->group(['middleware' => 'jwt.auth'], function() use ($router) {

    // get all users, test for token middleware
    $router->get('users', 'UserController@index');

    // message routes
    // create message 
    $router->post('message', 'MessageController@store');
    // get message by id
    $router->get('message/{id}', 'MessageController@get');
    // update message by id
    $router->put('message/{id}', 'MessageController@edit');
    // destroy message by id
    $router->delete('message/{id}', 'MessageController@destroy');

    // get all messages from a discussion
    $router->get('discussion/{id}', 'MessageController@getMessagesByDiscussion');
    
});