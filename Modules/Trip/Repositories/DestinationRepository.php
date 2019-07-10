<?php

namespace Modules\Trip\Repositories;
use App\Repositories\BaseRepository;
use Modules\Trip\Entities\Destination;

class DestinationRepository extends BaseRepository {

	function __construct(Destination $model) {
		$this->model = $model;
	}

	public function update($destination, $data) {

		return $destination->update($data);
	}

	public function delete($category) {
		$category->deleteTranslations();

		$category->delete();

	}
}
