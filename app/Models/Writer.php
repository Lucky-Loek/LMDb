<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
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
        return $this->belongsToMany(Screening::class);
    }
}
