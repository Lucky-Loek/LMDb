<?php

namespace App\Actions;

class CreateWriters
{
    /**
     * @var ExtractNames
     */
    private $extractNames;

    /**
     * @var CreateWriter
     */
    private $createWriter;

    /**
     * CreateWriters constructor.
     * @param ExtractNames $extractName
     * @param CreateWriter $createWriter
     */
    public function __construct(ExtractNames $extractName, CreateWriter $createWriter)
    {
        $this->extractNames = $extractName;
        $this->createWriter = $createWriter;
    }

    /**
     * Create Writers for every name in the OMDb response
     *
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function execute(array $data)
    {
        $names = $this->extractNames->execute($data);

        return collect($names)->map(function(string $name) {
            return $this->createWriter->execute(['name' => $name]);
        });
    }
}
