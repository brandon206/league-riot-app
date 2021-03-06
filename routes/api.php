<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('champions', 'RiotApiController@index');
Route::get('champions/{id}', 'RiotApiController@getChampion');
Route::get('summoner/{summonerName}', 'RiotApiController@getSummoner');
Route::get('summonerData/{encryptId}', 'RiotApiController@getSummonerData');
Route::get('summonerMatchHistory/{accountId}', 'RiotApiController@getSummonerMatchHistory');
Route::get('summonerSingleMatchData/{matchId}', 'RiotApiController@getSummonerSingleMatchData');
