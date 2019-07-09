<?php

namespace Modules\TripModule\Entities;

use Illuminate\Database\Eloquent\Model;

class TripCategoryTranslte extends Model
{
    public $timestamps = false;

    protected $table = 'trip_category_translation';

    protected $fillable = ['meta_title', 'meta_keywords', 'slug', 'meta_desc', 'description', 'title'];
}
