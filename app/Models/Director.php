<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Returns the Screenings that this director belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenings()
    {
        return $this->belongsToMany('App\Screening');
    }
}
