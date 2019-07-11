<?php

namespace Modules\Trip\Entities;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model {

	public $fillable =
		[
		'title',
		'desc',
		'note',
		'days',
		'price',
		'image',
		'include',
		'not_include',
	];

	public function getImageAttribute($image) {
		return 'public/upload/trips/trips/' . $image;
	}

	# Relations.
	public function categories() {
		return $this->belongsToMany(TripCategory::class, 'trip_categories', 'trip_id', 'category_id');

	}

	public function album() {
		return $this->hasMany(TripImage::class);
	}

	public function program() {
		return $this->hasMany(TripProgram::class);
	}

	public function destinations() {
		return $this->belongsToMany(Destination::class, 'trip_destinations', 'trip_id', 'destination_id');
	}

	public function booking() {
		return $this->hasMany(Booking::class);
	}

}
