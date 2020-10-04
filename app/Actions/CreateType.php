<?php

namespace App\Actions;

use App\Models\Type;

class CreateType
{
    /**
     * Return a Type if a director with the same name is found, else create a new one and return that.
     *
     * @param array $data
     * @return Type|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data)
    {
        return Type::firstOrCreate(['name' => $data['name']]);
    }
}
