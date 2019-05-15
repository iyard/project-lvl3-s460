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

$router->get('/', ['as' => 'index', 'uses' => 'IndexController@show']);
$router->post('/domains', 'DomainsController@store');
$router->get('/domains/{id}', ['as' => 'showdomain', 'uses' => 'DomainsController@show']);
