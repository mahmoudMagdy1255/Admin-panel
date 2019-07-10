<?php

namespace Modules\Trip\Entities;

use Illuminate\Database\Eloquent\Model;

class DestinationTranslation extends Model {
	public $timestamps = false;

	protected $fillable = ['title', 'desc'];
}
