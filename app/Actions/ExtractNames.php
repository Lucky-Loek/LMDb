<?php

namespace App\Actions;

class ExtractNames implements ActionInterface
{
    /**
     * Remove all non-name items, like "(Produced by)" from the names and then return all individual names from the
     * input string.
     *
     * @param array $data The input string with all the names from OMDb
     * @return array
     */
    public function execute(array $data)
    {
        $names = preg_replace("/\([^)]+\)/", "", $data['names']);
        $names = explode(', ', $names);

        $names = array_map(function($name) {
            return trim($name);
        }, $names);

        return $names;
    }
}
