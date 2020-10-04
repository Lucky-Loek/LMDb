<?php

namespace App\Actions;

use App\Models\Screening;

class CreateScreening implements ActionInterface
{
    /**
     * Create a screening with correct relations to other models.
     *
     * @param array $data
     * @return Screening|\Illuminate\Database\Eloquent\Model
     */
    public function execute(array $data)
    {
        $screening =  Screening::updateOrCreate(
            ['title' => $data['title'], 'year' => $data['year']],
            $data
        );

        $screening->actors()->saveMany($data['actors']);
        $screening->directors()->saveMany($data['directors']);
        $screening->genres()->saveMany($data['genres']);
        $screening->writers()->saveMany($data['writers']);
        $screening->type()->associate($data['type']);

        $screening->save();

        return $screening;
    }
}
