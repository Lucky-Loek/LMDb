<?php

namespace App\Actions;

use App\Models\Writer;

class CreateWriter implements ActionInterface
{
    /**
     * Return a Writer if a writer with the same name is found, else create a new one and return that.
     *
     * @param array $data
     * @return Writer|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data)
    {
        return Writer::firstOrCreate(['name' => $data['name']]);
    }
}
