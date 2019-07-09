<?php

namespace Modules\TripModule\Entities;

use Modules\TripModule\Entities\Trip;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class TripCategory extends Model
{
    use Translatable;

    public $translationModel = TripCategoryTranslte::class;

    public $translatedAttributes = ['meta_title', 'meta_keywords', 'slug', 'meta_desc', 'description', 'title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trip_category';

    protected $fillable = ['photo', 'cover_photo', 'parent_id'];



    public function child()
    {
        return $this->hasMany(TripCategory::class, 'parent_id', 'id');
    }

    protected function trips(){
        return $this->belongsToMany(Trip::class, 'trip_categ_pivot', 'category_id', 'trip_id');
    }

   public function parent()
    {
        return $this->belongsTo(TripCategory::class, 'parent_id', 'id');
    }
}
