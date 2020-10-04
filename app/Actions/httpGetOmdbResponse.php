<?php

namespace App\Actions;

use App\Clients\Client;

class httpGetOmdbResponse implements ActionInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * httpGetOmdbResponse constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return decoded json response from OMDb API
     *
     * @param array $data
     * @return \StdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(array $data): \StdClass
    {
        $response = $this->client->getScreeningByImdbId($data['Const']);
        return json_decode($response);
    }
}
