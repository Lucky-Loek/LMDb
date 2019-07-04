<?php

namespace App\Actions;

class CreateActors implements ActionInterface
{
    /**
     * @var ExtractNames
     */
    private $extractNames;

    /**
     * @var CreateActor
     */
    private $createActor;

    /**
     * CreateActors constructor.
     * @param ExtractNames $extractNames
     * @param CreateActor $createActor
     */
    public function __construct(ExtractNames $extractNames, CreateActor $createActor)
    {
        $this->extractNames = $extractNames;
        $this->createActor = $createActor;
    }

    /**
     * Create Actors for every name in the OMDb response
     *
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function execute(array $data)
    {
        $names = $this->extractNames->execute($data);

        return collect($names)->map(function(string $name) {
            return $this->createActor->execute(['name' => $name]);
        });
    }
}
