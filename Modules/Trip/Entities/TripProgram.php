<?php

namespace Modules\TripModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class TripProgram extends Model
{
    use Translatable;

    public $translationModel = TripProgramTrans::class;

    public $translatedAttributes = ['description', 'title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trip_program';

    protected $fillable = ['trip_id'];

    # Relations.
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

}
