<?php

namespace App\Service;

use App\Actor;
use App\Director;
use App\Genre;
use App\Screening;
use App\Type;
use App\Writer;

class ImportService
{
    /**
     * @var CsvReaderService
     */
    private $csvReaderService;

    /**
     * @var ApiService
     */
    private $apiService;

    public function __construct(
        CsvReaderService $csvReaderService,
        ApiService $apiService
    ) {
        $this->csvReaderService = $csvReaderService;
        $this->apiService = $apiService;
    }

    public function processWatchlist()
    {
        // Read CSV
        $imdbElements = $this->csvReaderService->readWatchlist();

        // Run line for line through api
        foreach ($imdbElements as $imdbElement) {

            // Check if already in database
            $screening = Screening::whereImdbId($imdbElement['Const'])->first();

            if (empty($screening)) {
                $processedElement = $this->apiService->processImdbElement($imdbElement);

                $type = Type::where('type', $processedElement->Type)->first();
                $screening = $this->createScreeningFromResponse($processedElement, $type);

                $message = 'Inserted screening with id "' . $screening->id . '" and title "' . $screening->title . '"';
                \Log::info($message);
                dump($message);
            } else {
                $message = 'Already found screening with id "' . $screening->id . '" and title "' . $screening->title . '"';
                \Log::info($message);
                dump($message);
            }
        }
    }

    private function createScreeningFromResponse(\StdClass $decoded, Type $type): Screening
    {
        $actors = $this->createAndGetItemsFromString($decoded->Actors, Actor::class);
        $directors = $this->createAndGetItemsFromString($decoded->Director, Director::class);
        $genres = $this->createAndGetItemsFromString($decoded->Genre, Genre::class);
        $writers = $this->createAndGetItemsFromString($decoded->Writer, Writer::class);

        $posterFilePaths = $this->savePosterAndReturnFilePaths($decoded->Poster, $decoded->Title);

        $screening = Screening::create([
            'title' => $decoded->Title,
            'year' => $decoded->Year,
            'runtime' => $decoded->Runtime,
            'poster_file_path' => $posterFilePaths['file_path'],
            'poster_thumbnail_file_path' => $posterFilePaths['thumbnail_file_path'],
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
        // Remove all non-name items, like "(Produced by) from the names"
        $items = preg_replace("/\([^)]+\)/", "", $items);
        $itemNames = explode(', ', $items);

        $items = array_map(function($name) use ($className) {
            return $className::firstOrCreate(['name' => trim($name)]);
        }, $itemNames);

        return $items;
    }

    private function savePosterAndReturnFilePaths(string $posterUrl, string $screeningTitle): array
    {
        $image = \Image::make($posterUrl);

        // Replace all weird characters but digits and alphabetic characters
        $screeningTitle = strtolower($screeningTitle);
        $screeningTitle = preg_replace('/[^\da-z]/', '_', $screeningTitle);

        $filePath = $screeningTitle . '.jpg';
        $thumbnailFilePath = $screeningTitle . '_thumb.jpg';

        $image->save(storage_path('app/public/') . $filePath);
        $image = $image->widen(224); // Bulma grid = 1344px. Divided by 6 (for 6 columns) gives 224px per image.
        $image->save(storage_path('app/public/') . $thumbnailFilePath);

        return [
            'file_path' => $filePath,
            'thumbnail_file_path' => $thumbnailFilePath
        ];
    }
}
