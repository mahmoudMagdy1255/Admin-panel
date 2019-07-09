<?php

namespace Modules\TripModule\Entities;

use Modules\TripModule\Entities\Trip;
use Illuminate\Database\Eloquent\Model;

class TripPhotos extends Model
{
    protected $fillable = ['photo'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trip_photos';

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
