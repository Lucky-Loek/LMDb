<?php

namespace App\Client;

use GuzzleHttp\Psr7\Request;

class Client
{
    private $client;
    private $apiKey;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('lmdb.api_key');
    }

    public function getScreeningById(string $imdbId): string
    {
        // #TODO Refactor URI to function that takes array as input, foreaches through it and returns string
        $request = new Request(
            'get',
            'https://www.omdbapi.com/?apikey=' . $this->apiKey . '&i=' . $imdbId,
        );

        $response = $this->client->send($request);

        return $response->getBody()->getContents();
    }
}
