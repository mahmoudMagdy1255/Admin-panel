<?php

namespace Modules\Config\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Config extends Model {

	use Translatable;

	protected $fillable = ['logo', 'background', 'phone'];

	protected $translationModel = ConfigTranslation::class;

	protected $translatedAttributes = ['title', 'desc', 'address'];

	public function getBackgroundAttribute($image) {
		return 'public/upload/configs/' . $image;
	}

	public function getLogoAttribute($image) {
		return 'public/upload/configs/' . $image;
	}

}
