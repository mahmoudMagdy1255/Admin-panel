<?php

namespace Modules\TripModule\Entities;

use Illuminate\Database\Eloquent\Model;

class TripTranslate extends Model
{
    protected $fillable = [
        'title', 'description', 'short_desc', 'note',  'price', 'meta_title', 'meta_desc', 'meta_keywords', 'slug', 'include', 'not_include'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trips_translation';

    public $timestamps = false;
}
