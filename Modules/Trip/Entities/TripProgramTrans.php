<?php

namespace Modules\TripModule\Entities;

use Illuminate\Database\Eloquent\Model;

class TripProgramTrans extends Model
{
    public $timestamps = false;

    protected $table = 'trip_program_trans';

    protected $fillable = ['description', 'title'];
}
