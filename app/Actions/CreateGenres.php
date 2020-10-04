<?php

namespace App\Actions;

class CreateGenres
{
    /**
     * @var ExtractNames
     */
    private $extractNames;

    /**
     * @var CreateGenre
     */
    private $createGenre;

    /**
     * CreateGenres constructor.
     * @param ExtractNames $extractNames
     * @param CreateGenre $createGenre
     */
    public function __construct(ExtractNames $extractNames, CreateGenre $createGenre)
    {
        $this->extractNames = $extractNames;
        $this->createGenre = $createGenre;
    }

    /**
     * Create Genres for every name in the OMDb response
     *
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function execute(array $data)
    {
        $names = $this->extractNames->execute($data);

        return collect($names)->map(function(string $name) {
            return $this->createGenre->execute(['name' => $name]);
        });
    }
}
