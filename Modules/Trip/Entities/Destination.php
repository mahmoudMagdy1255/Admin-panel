<?php

namespace Modules\Trip\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model {
	use Translatable;

	protected $guarded = [];

	public $translatedAttributes = ['title', 'desc'];

	# Relations

	public function getImageAttribute($image) {
		return 'public/upload/trips/destinations/' . $image;
	}

	public function trips() {
		return $this->belongsToMany(Trip::class, 'trip_destination', 'destination_id', 'trip_id');
	}
}
