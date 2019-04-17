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

    public function ietsofzo()
    {
        $response = $this->client->getScreeningById('tt0111161');

        $decoded = json_decode($response);

        $actors = $this->createAndGetItemsFromString($decoded->Actors, Actor::class);
        $directors = $this->createAndGetItemsFromString($decoded->Director, Director::class);
        $genres = $this->createAndGetItemsFromString($decoded->Genre, Genre::class);
        $type = Type::where('type', $decoded->Type);
    }

    private function createAndGetItemsFromString(string $items, string $className): array
    {
        $itemNames = explode(', ', $items);

        $items = [];
        foreach ($itemNames as $name) {
            $items[] = $className::firstOrCreate(['name' => $name]);
        }

        return $items;
    }

    public function processImdbElements(array $imdbElements)
    {
    }
}
