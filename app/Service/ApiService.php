<?php

namespace App\Service;

use App\Actor;
use App\Client\Client;
use App\Director;
use App\Genre;
use App\Screening;
use App\Type;
use App\Writer;

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

    public function processImdbElements(array $imdbElements): void
    {
        $counter = 0;

        foreach ($imdbElements as $imdbElement) {
            $response = $this->client->getScreeningByImdbId($imdbElement['Const']);
            $decoded = json_decode($response);


            $type = Type::where('type', $decoded->Type)->first();
            $screening = $this->createScreeningFromResponse($decoded, $type);

            dump($screening->id, $screening->title);

            if($counter === 900) {
                exit;
            }

            $counter++;
        }
    }

    private function createScreeningFromResponse(\StdClass $decoded, Type $type): Screening
    {
        $actors = $this->createAndGetItemsFromString($decoded->Actors, Actor::class);
        $directors = $this->createAndGetItemsFromString($decoded->Director, Director::class);
        $genres = $this->createAndGetItemsFromString($decoded->Genre, Genre::class);
        $writers = $this->createAndGetItemsFromString($decoded->Writer, Writer::class);


        $screening = Screening::create([
            'title' => $decoded->Title,
            'year' => $decoded->Year,
            'runtime' => $decoded->Runtime,
            'poster_file_path' => $decoded->Poster, // #TODO change to getting actual image and writing to filesystem, including thumbnail
            'imdb_rating' => $decoded->imdbRating,
            'imdb_id' => $decoded->imdbID,
            'type_id' => $type->id,
            'count' => 1,
        ]);

        $screening->actors()->saveMany($actors);
        $screening->directors()->saveMany($directors);
        $screening->genres()->saveMany($genres);
        $screening->writers()->saveMany($writers);

        $screening->save();

        return $screening;
    }

    private function createAndGetItemsFromString(string $items, string $className): array
    {
        $items = preg_replace("/\([^)]+\)/", "", $items);
        $itemNames = explode(', ', $items);

        $items = [];
        foreach ($itemNames as $name) {
            $name = trim($name);
            $items[] = $className::firstOrCreate(['name' => $name]);
        }

        return $items;
    }
}
