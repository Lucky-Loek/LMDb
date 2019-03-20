<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = [
        'parent_id',
        'type_id',
        'title',
        'year',
        'runtime',
        'poster_file_path',
        'poster_thumbnail_file_path',
        'imdb_rating',
        'imdb_id',
        'count'
    ];

    /**
     * Returns the Type that this screening belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function types()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * Return the Screening that this screening belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenings()
    {
        return $this->belongsTo('App\Screening');
    }
}
