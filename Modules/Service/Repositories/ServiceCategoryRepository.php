<?php

namespace Modules\Service\Repositories;

use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceCategory;

class ServiceCategoryRepository extends BaseRepository {
	function __construct(ServiceCategory $model) {
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