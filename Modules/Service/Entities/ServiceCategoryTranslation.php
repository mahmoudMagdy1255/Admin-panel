<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceCategoryTranslation extends Model {

	protected $tmestamp = false;
	protected $fillable = ['title', 'desc'];

}
