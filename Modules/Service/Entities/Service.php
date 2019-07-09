<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {
	protected $fillable = ['title', 'desc', 'image', 'price', 'user_id', 'category_id'];

	public function category() {
		return $this->belongsTo(ServiceCategory::class);
	}

	public function getImageAttribute($image) {
		return 'public/upload/services/services/' . $image;
	}

}
