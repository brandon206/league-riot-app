<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RiotApiController extends Controller
{
    public function index()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.23.1/data/en_US/champion.json');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

    	return $body;
    }

    public function getChampion($id) {
        $client = new Client();
        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.13.1/data/en_US/champion/'.$id.'.json');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

    	return $body;
    }

    public function getSummoner($summonerName) {
        $client = new Client();
        $api_key = env("RIOT_API_KEY", 'default_api_key');
        $response = $client->request('GET', 'https://na1.api.riotgames.com/lol/summoner/v4/summoners/by-name/'.$summonerName.'?api_key='.$api_key);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return $body;
    }

    // Use encryptId to get Summoner specific data
    public function getSummonerData($encryptId) {
        $client = new Client();
        $api_key = env('RIOT_API_KEY', 'default_api_key');
        $response = $client->request('GET', 'https://na1.api.riotgames.com/lol/league/v4/entries/by-summoner/'.$encryptId.'?api_key='.$api_key);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return $body;
    }

    public function getSummonerMatchHistory($accountId) {
        $client = new Client();
        $api_key = env('RIOT_API_KEY', 'default_api_key');
        $response = $client->request('GET', 'https://na1.api.riotgames.com//lol/match/v4/matchlists/by-account/'.$accountId.'?api_key='.$api_key);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return $body;
    }
}