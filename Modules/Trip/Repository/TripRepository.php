<?php

namespace Modules\TripModule\Repository;

use File;
use Modules\TripModule\Entities\Destination;
use Modules\TripModule\Entities\Trip;

class TripRepository {
	private $tripPhotos;

	public function __construct(TripPhotosRepository $tripPhotos) {
		$this->tripPhotos = $tripPhotos;
	}

	public function findAll() {
		$trips = Trip::with(['categories', 'categories.translations', 'destinations', 'destinations.translations', 'photos', 'translations'])->get();
		return $trips;
	}

	public function find($id) {
		return Trip::where('id', $id)->with(['photos', 'translations', 'program'])->first();
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

	public function save($data, $pics, $destination, $categories) {
		$trip = Trip::create($data);
		$trip->destinations()->sync($destination);
		$trip->categories()->sync($categories);
		$this->tripPhotos->save($trip, $pics);
	}

	/**
	 * Save New Photos selected to album.
	 *
	 * @param   [type]  $id    [$id description]
	 * @param   [type]  $pics  [$pics description]
	 *
	 * @return  [type]         [return description]
	 */
	public function updateAlbumPhotos($id, $pics) {
		$trip = $this->find($id);
		$this->tripPhotos->save($trip, $pics);
	}

	public function update($id, $data, $data_trans, $tripDestinations, $tripCategories) {
		$trip = $this->find($id);

		$trip->update($data);
		$trip->destinations()->sync($tripDestinations);
		$trip->categories()->sync($tripCategories);

		$trip->save();

		foreach (\LanguageHelper::getLang() as $lang) {

			if ($trip->hasTranslation('' . $lang->lang)) {
			} else {
				$trip->translateOrNew('' . $lang->lang);
			}

			if (isset($data_trans[$lang->lang]['title']) && !empty($data_trans[$lang->lang]['title'])) {
				$trip->translate('' . $lang->lang)->title = $data_trans[$lang->lang]['title'];
				$trip->translate('' . $lang->lang)->description = $data_trans[$lang->lang]['description'];
				$trip->translate('' . $lang->lang)->short_desc = $data_trans[$lang->lang]['short_desc'];
				$trip->translate('' . $lang->lang)->not_include = $data_trans[$lang->lang]['not_include'];
				$trip->translate('' . $lang->lang)->include = $data_trans[$lang->lang]['include'];
				$trip->translate('' . $lang->lang)->meta_title = $data_trans[$lang->lang]['meta_title'];
				$trip->translate('' . $lang->lang)->meta_desc = $data_trans[$lang->lang]['meta_desc'];
				$trip->translate('' . $lang->lang)->slug = $data_trans[$lang->lang]['slug'];
				$trip->translate('' . $lang->lang)->meta_keywords = $data_trans[$lang->lang]['meta_keywords'];
				$trip->translate('' . $lang->lang)->note = $data_trans[$lang->lang]['note'];

				$trip->save();
			}
		}
		//Debugbar::info(" title in ".$lang->lang." is ->  ".$data_trans[$lang->lang]['title']);
		return $trip;
	}

	public function delete($trip) {
		if ($trip->photo) {
			$file_path = public_path() . '/images/trip/' . $trip->photo;
			$thumbnail_path = public_path() . '/images/trip/thumb/' . $trip->photo;
			File::delete([$file_path, $thumbnail_path]);
		}
		Trip::destroy($trip->id);
	}

	public function TripsOfCategory($id, $pagelimit) {
		$trips = Trip::with(['destinations', 'photos'])->where('trip_category_id', $id)->paginate($pagelimit);
		return $trips;
	}

	public function TripsOfDestination($id, $pagelimit) {
		$destination = Destination::where('id', $id)->with('translations')->first();
		$trips = $destination->trips()->paginate($pagelimit);
		return $trips;
	}

	public function findLastByLimit($limit, $exclude = '') {
		$trips = Trip::where('id', '!=', $exclude)->with(['categories', 'categories.translations', 'translations'])->orderBy('created_at', 'desc')->take($limit)->get();
		return $trips;
	}
}
