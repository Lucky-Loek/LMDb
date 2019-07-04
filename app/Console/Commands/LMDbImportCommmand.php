<?php

namespace App\Console\Commands;

use App\Actions\CreateActors;
use App\Actions\CreateDirectors;
use App\Actions\CreateGenres;
use App\Actions\CreatePoster;
use App\Actions\CreateScreening;
use App\Actions\CreateTypes;
use App\Actions\CreateWriters;
use App\Actions\ExtractWatchlist;
use App\Actions\httpGetOmdbResponse;
use Illuminate\Console\Command;

class LMDbImportCommmand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lmdb:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads watchlist and imports its screenings from the OMDb API';

    /**
     * @var httpGetOmdbResponse
     */
    private $httpGetOmdbResponse;

    /**
     * @var CreateActors
     */
    private $createActors;

    /**
     * @var CreateDirectors
     */
    private $createDirectors;

    /**
     * @var CreateWriters
     */
    private $createWriters;

    /**
     * @var CreateGenres
     */
    private $createGenres;

    /**
     * @var CreatePoster
     */
    private $createPoster;

    /**
     * @var CreateScreening
     */
    private $createScreening;

    /**
     * @var CreateTypes
     */
    private $createTypes;

    /**
     * Create a new command instance.
     *
     * @param httpGetOmdbResponse $getOMDbResponse
     * @param CreateActors $createActors
     * @param CreateDirectors $createDirectors
     * @param CreateWriters $createWriters
     * @param CreateGenres $createGenres
     * @param CreateTypes $createTypes
     * @param CreatePoster $createPoster
     * @param CreateScreening $createScreening
     */
    public function __construct(
        httpGetOmdbResponse $getOMDbResponse,
        CreateActors $createActors,
        CreateDirectors $createDirectors,
        CreateWriters $createWriters,
        CreateGenres $createGenres,
        CreateTypes $createTypes,
        CreatePoster $createPoster,
        CreateScreening $createScreening
    ) {
        parent::__construct();
        $this->httpGetOmdbResponse = $getOMDbResponse;
        $this->createActors = $createActors;
        $this->createDirectors = $createDirectors;
        $this->createWriters = $createWriters;
        $this->createGenres = $createGenres;
        $this->createPoster = $createPoster;
        $this->createScreening = $createScreening;
        $this->createTypes = $createTypes;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = config('lmdb.watchlist_filename');
        $extractedWatchlist = (new ExtractWatchlist())->execute(['filePath' => $filePath]);

        foreach ($extractedWatchlist as $row) {
            if (empty($row)) {
                $this->output->writeln('Importing is done!');
                break;
            }

            $response = $this->httpGetOmdbResponse->execute($row);
            $actors = $this->createActors->execute(['names' => $response->Actors]);
            $directors = $this->createDirectors->execute(['names' => $response->Director]);
            $writers = $this->createWriters->execute(['names' => $response->Writer]);
            $genres = $this->createGenres->execute(['names' => $response->Genre]);
            $types = $this->createTypes->execute(['names' => $response->Type]);
            $posters = $this->createPoster->execute(['posterUrl' => $response->Poster, 'title' => $response->Title]);
            $screening = $this->createScreening->execute([
                'title' => $response->Title,
                'year' => $response->Year,
                'runtime' => $response->Runtime,
                'poster_file_path' => $posters['poster_file_path'],
                'poster_thumbnail_file_path' => $posters['poster_thumbnail_file_path'],
                'imdb_rating' => $response->imdbRating,
                'imdb_id' => $response->imdbID,
                'actors' => $actors,
                'directors' => $directors,
                'writers' => $writers,
                'genres' => $genres,
                'type' => $types[0]
            ]);

            $this->output->writeln('Saved screening with id "' . $screening->id . '" and title "' . $screening->title . '"');
        }
    }
}
