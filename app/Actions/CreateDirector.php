<?php

namespace App\Actions;

use App\Director;

class CreateDirector implements ActionInterface
{
    /**
     * Return a Director if a director with the same name is found, else create a new one and return that.
     *
     * @param array $data
     * @return Director|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data)
    {
        return Director::firstOrCreate(['name' => $data['name']]);
    }
}
