<?php

namespace Modules\Trip\Repositories;

use App\Repositories\BaseRepository;
use Modules\Trip\Entities\Trip;

class TripRepository extends BaseRepository {
	private $tripPhotos;

	public function __construct(Trip $model) {
		$this->model = $model;
	}

	public function numbers($val) {
		preg_match('/[0-9.]+$/', $val, $match);

		return intval($match[0]);
	}

	public function search($request) {
		$prices = explode('-', $request['price']);

		$min = $this->numbers(trim($prices[0]));

		$max = $this->numbers(trim($prices[1]));

		$trips = Trip::whereBetween('price', [$min, $max])->get();

		$firstTrips = [];
		$secondTrips = [];

		foreach ($trips as $trip) {

			$categories = $trip->categories()->get()->pluck('id')->toArray();

			if (in_array($request['cat_id'], $categories)) {
				$firstTrips[] = $trip;
			}

		}

		foreach ($firstTrips as $trip) {

			$categories = $trip->destinations()->get()->pluck('id')->toArray();

			if (in_array($request['dest_id'], $categories)) {
				$secondTrips[] = $trip;
			}

		}

		return $secondTrips;

		/*Trip::whereTranslationLike('description', $trip)->orWhereTranslationLike('short_desc', $trip)->orWhereTranslationLike('slug', $trip)->with(['photos', 'translations', 'program'])->get();*/

	}

	public function addCategories($trip, $categories) {

		$trip->categories()->attach($categories);

	}

	public function addDestinations($trip, $destinations) {

		$trip->destinations()->attach($destinations);
	}

}
