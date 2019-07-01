<?php

namespace App\Service;

use App\Client\Client;

class ApiService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function processImdbElement(array $imdbElement): \StdClass
    {
        $response = $this->client->getScreeningByImdbId($imdbElement['Const']);
        return json_decode($response);
    }
}
