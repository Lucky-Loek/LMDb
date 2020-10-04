<?php

namespace App\Actions;

class CreateDirectors
{
    /**
     * @var ExtractNames
     */
    private $extractNames;

    /**
     * @var CreateDirector
     */
    private $createDirector;

    /**
     * CreateDirectors constructor.
     * @param ExtractNames $extractNames
     * @param CreateDirector $createDirector
     */
    public function __construct(ExtractNames $extractNames, CreateDirector $createDirector)
    {
        $this->extractNames = $extractNames;
        $this->createDirector = $createDirector;
    }

    /**
     * Create Directors for every name in the OMDb response
     *
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function execute(array $data)
    {
        $names = $this->extractNames->execute($data);

        return collect($names)->map(function(string $name) {
            return $this->createDirector->execute(['name' => $name]);
        });
    }
}
