<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Return the Screenings that have this type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
}
