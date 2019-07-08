<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceCategoryTranslation extends Model {

	public $timestamps = false;
	protected $fillable = ['title', 'desc'];

}
