<?php

namespace App\Clients;

use GuzzleHttp\Psr7\Request;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('lmdb.api_key');
    }

    /**
     * Get all data available for given IMDb ID out of the OMDb API.
     *
     * @param string $imdbId
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getScreeningByImdbId(string $imdbId): string
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
