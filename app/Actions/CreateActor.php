<?php

namespace App\Actions;

use App\Models\Actor;

class CreateActor implements ActionInterface
{
    /**
     * Return an Actor if an actor with the same name is found, else create a new one and return that.
     *
     * @param array $data
     * @return Actor|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data): Actor
    {
        return Actor::firstOrCreate(['name' => $data['name']]);
    }
}
