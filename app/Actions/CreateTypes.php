<?php

namespace App\Actions;

class CreateTypes
{
    /**
     * @var ExtractNames
     */
    private $extractNames;
    /**
     * @var CreateType
     */
    private $createType;

    /**
     * CreateTypes constructor.
     * @param ExtractNames $extractNames
     * @param CreateType $createType
     */
    public function __construct(ExtractNames $extractNames, CreateType $createType)
    {
        $this->extractNames = $extractNames;
        $this->createType = $createType;
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
            return $this->createType->execute(['name' => $name]);
        });
    }
}
