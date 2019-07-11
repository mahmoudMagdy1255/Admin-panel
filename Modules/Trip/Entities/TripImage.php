<?php

namespace Modules\Trip\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Trip\Entities\Trip;

class TripImage extends Model {
	protected $fillable = ['image', 'trip_id', 'size', 'mime_type'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	public function getImageAttribute($image) {
		return 'public/upload/trips/trips/albums/' . $image;
	}
	public function trip() {
		return $this->belongsTo(Trip::class);
	}
}
