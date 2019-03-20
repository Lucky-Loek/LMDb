<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Returns the Screenings that this genre belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenings()
    {
        return $this->belongsToMany('App\Screening');
    }
}
