<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RiotApiController extends Controller
{
    public function index()
    {
        $client = new Client();
    	// $response = $client->request('GET', 'https://api.pandascore.co/lol/champions?token=9hBdfanuM4g5NGYky5NJAxrKFSNqbg2G1Xr2V52TaTdmFgHm0x0');
        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.3.1/data/en_US/champion.json');
        $statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

    	return $body;
    }
}