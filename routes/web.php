<?php

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
    return response(view('home'));
});

$router->group(['namespace' => 'Api', 'prefix' => 'api'], function () use ($router) {
    // Using The "App\Http\Controllers\Api" Namespace...

    $router->group(['namespace' => 'v1', 'prefix' => 'v1'], function () use ($router) {
        // Using The "App\Http\Controllers\Api" Namespace...

        // Site da infocorp
        $router->group(['prefix' => 'infocorp'], function () use ($router) {
            $router->post('contato', ['uses' => 'SlackbotController@infocorpContato']);
        });
    });
});