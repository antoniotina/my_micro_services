<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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

//Lumen

$router->post('/register', function (Request $request) use ($router) {
    return Http::post('http://localhost:8001/register', [
        'name' =>  $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'password_confirmation' => $request->password_confirmation
    ]);
});

$router->post('/login', function (Request $request) use ($router) {
    return Http::post('http://localhost:8001/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);
});

$router->get('/users', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->get('http://localhost:8001/users');
});

$router->post('/message', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->post('http://localhost:8001/message',[
        'content' => $request->content,
        'discussion_id' => $request->discussion_id
    ]);
});

$router->get('/message/{id}', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->get('http://localhost:8001/message/'.$request->id);
});

$router->put('/message/{id}', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->put('http://localhost:8001/message/'.$request->id,[
        'content' => $request->content,
        'discussion_id' => $request->discussion_id
    ]);
});

$router->delete('/message/{id}', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->delete('http://localhost:8001/message/'.$request->id);
});

$router->get('/discussion/{id}', function (Request $request) use ($router) {
    return Http::withToken($request->header('token'))->get('http://localhost:8001/discussion/'.$request->id);
});

//Nodejs

$router->get('/find', function (Request $request) use ($router) {
    return  Http::get('http://localhost:3100/find', [
        'id' => $request->id,
        ]);
});

$router->post('/create', function (Request $request) use ($router) {
    return  Http::post('http://localhost:3100/create', [
        'name' =>  $request->name,
        'users' => $request->users
    ]);
});

$router->put('/update', function (Request $request) use ($router) {
    return  Http::put('http://localhost:3100/update', [
        'id' =>  $request->id,
        'users' => $request->users
    ]);
});

$router->delete('/delete', function (Request $request) use ($router) {
    return  Http::delete('http://localhost:3100/delete', [
        'id' =>  $request->id
    ]);
});
