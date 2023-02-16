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
// routes pour les locations
$router->get('/api/locations','LocationController@index');
$router->get('/api/locations/{id}','LocationController@show');
$router->post('/api/locations/','LocationController@store');
$router->put('/api/locations/update/{id}','LocationController@update');

$router->delete('/api/locations/{id}','LocationController@destroy');

// places
$router->get('/api/locations/{id}/places','PlaceController@show');
$router->post('/api/locations/{id}/places','PlaceController@store');

$router->put('/api/places/{id}','PlaceController@update');
$router->delete('/api/places/{id}','PlaceController@destroy');


$router->get('/', function () use ($router) {
    return $router->app->version();
});
