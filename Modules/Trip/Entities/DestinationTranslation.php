<?php

namespace Modules\TripModule\Entities;

use Illuminate\Database\Eloquent\Model;

class DestinationTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'destinations_translation';

    protected $fillable = ['title', 'description'];
}
