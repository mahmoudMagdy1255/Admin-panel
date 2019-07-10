<?php

namespace Modules\Trip\Entities;

use Illuminate\Database\Eloquent\Model;

class TripCategoryTranslation extends Model {
	public $timestamps = false;

	protected $fillable = ['desc', 'title'];
}
