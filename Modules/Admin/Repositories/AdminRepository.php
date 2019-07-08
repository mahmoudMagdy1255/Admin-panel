<?php

namespace Modules\Admin\Repositories;

use App\Repositories\BaseRepository;
use Modules\Admin\Entities\Admin;

class AdminRepository extends BaseRepository {
	function __construct(Admin $model) {
		$this->model = $model;
	}

	public function update($id, $data) {
		$model = $this->model->findOrFail($id);

		return $model->update($data);
	}

}