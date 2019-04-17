<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Returns the Types that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany('App\Type');
    }

    /**
     * Return the Screening that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function screenings()
    {
        return $this->belongsToMany('App\Screening');
    }

    /**
     * Return the Writer that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function writers()
    {
        return $this->belongsToMany('App\Writer');
    }
}
