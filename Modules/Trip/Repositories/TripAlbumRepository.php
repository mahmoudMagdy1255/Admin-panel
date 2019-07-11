<?php

namespace Modules\Trip\Repositories;

use App\Repositories\BaseRepository;
use File;
use Modules\Common\Services\LocalFiles;
use Modules\Trip\Entities\Trip;
use Modules\Trip\Entities\TripImage;

class TripAlbumRepository extends BaseRepository {
	use LocalFiles;

	function __construct(TripImage $model) {
		$this->model = $model;
	}

	public function delete($trip) {
		# Delete Photo Albums from /Images/trips.
		if ($trip->photos->all()) {
			$file_path = [];
			foreach ($trip->photos->all() as $photo) {
				$file_path[] = public_path() . '/images/trips/' . $photo->photo;
			}

			File::delete($file_path);
		}
	}

	public function deletePic($id) {
		$pic = TripImage::where('id', $id)->first();
		$file_path = public_path() . '/images/trips/' . $pic->photo;
		File::delete($file_path);

		return TripImage::destroy($pic->id);
	}
}
