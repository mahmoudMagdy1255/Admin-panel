<?php

namespace Modules\Service\Repositories;

use App\Repositories\BaseRepository;
use Modules\Service\Entities\Service;

class ServiceRepository extends BaseRepository {
	function __construct(Service $model) {
		$this->model = $model;
	}

	public function update($id, $data) {
		$model = $this->model->findOrFail($id);

		return $model->update($data);
	}

}