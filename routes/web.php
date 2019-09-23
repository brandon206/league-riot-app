<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use GuzzleHttp\Client;

// Route::get('/json-api', function() {
// 	$client = new Client();

// 	$response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/1');
// 	$statusCode = $response->getStatusCode();
// 	$body = $response->getBody()->getContents();

// 	return $body;
// });

Route::get('/{any}', 'SpaController@index')->where('any', '.*');

