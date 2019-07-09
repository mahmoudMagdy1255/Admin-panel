<?php

namespace Modules\Service\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model {

	use Translatable;

	public function getImageAttribute($image) {
		return 'public/upload/services/categories/' . $image;
	}

	protected $translatedAttributes = ['title', 'desc'];

	protected $translationModel = ServiceCategoryTranslation::class;

	protected $fillable = ['image', 'parent_id'];
}
