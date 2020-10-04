<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use const Grpc\WRITE_BUFFER_HINT;

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
    ];

    /**
     * Return the Actors that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    /**
     * Return the Directors that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }

    /**
     * Return the Genres that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Return the Screening that this screening belongs to.
     *
     * @return BelongsTo
     */
    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    /**
     * Returns the Type that this screening belongs to.
     *
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Return the Writers that this screening belongs to.
     *
     * @return BelongsToMany
     */
    public function writers()
    {
        return $this->belongsToMany(Writer::class);
    }

    /**
     * Add one to count of screenings and return the new screening.
     *
     * @return $this
     */
    public function addOneToCount()
    {
        $this->count++;
        $this->save();
        return $this;
    }
}
