<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RiotApiController extends Controller
{
    public function index()
    {
        $client = new Client();
        // dd('http://ddragon.leagueoflegends.com/cdn/9.3.1/data/en_US/champion.json');
    	// $response = $client->request('GET', 'https://api.pandascore.co/lol/champions?token=9hBdfanuM4g5NGYky5NJAxrKFSNqbg2G1Xr2V52TaTdmFgHm0x0');
        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.3.1/data/en_US/champion.json');
        // dd($response);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        // dd($body);

    	return $body;
    }

    public function getChampion($id) {
        $client = new Client();
        // dd($id);
        // dd('http://ddragon.leagueoflegends.com/cdn/9.3.1/data/en_US/champion/'.$id.'.json');
        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.13.1/data/en_US/champion/'.$id.'.json');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

    	return $body;
    }

    // Riot only provides temporary keys you'll need to change this every 24 hours until we get approval
    public function getSummoner($summonerName) {
        $client = new Client();
        $api_key = env('RIOT_API_KEY', 'default_api_key');
        $response = $client->request('GET', 'https://na1.api.riotgames.com/lol/summoner/v4/summoners/by-name/'.$summonerName.'?api_key='.$api_key);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return $body;
    }
}