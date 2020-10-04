<?php

namespace App\Actions;

use App\Models\Genre;

class CreateGenre implements ActionInterface
{
    /**
     * Return a Genre if a genre with the same name is found, else create a new one and return that.
     *
     * @param array $data
     * @return Genre|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data)
    {
        return Genre::firstOrCreate(['name' => $data['name']]);
    }
}
