<?php

namespace Modules\Trip\Repositories;

use App\Repositories\BaseRepository;
use Modules\Trip\Entities\TripCategory;

class TripCategoryRepository extends BaseRepository {

	function __construct(TripCategory $model) {
		$this->model = $model;
	}

	public function update($id, $data) {
		$model = $this->model->findOrFail($id);

		return $model->update($data);
	}
	public function delete($category) {
		$category->deleteTranslations();

		$category->delete();

	}

}
