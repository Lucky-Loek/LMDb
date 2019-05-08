<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * Returns the Type that this screening belongs to.
     *
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * Return the Screening that this screening belongs to.
     *
     * @return BelongsTo
     */
    public function screening()
    {
        return $this->belongsTo('App\Screening');
    }

    /**
     * Return the Writers that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function writers()
    {
        return $this->belongsToMany('App\Writer');
    }

    /**
     * Return the Actors that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany('App\Actor');
    }

    /**
     * Return the Directors that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function directors()
    {
        return $this->belongsToMany('App\Director');
    }

    /**
     * Return the Genres that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }
}
