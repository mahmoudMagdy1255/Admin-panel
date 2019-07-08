<?php

namespace Modules\User\Repositories;

use App\Repositories\BaseRepository;
use Modules\User\Entities\User;

class UserRepository extends BaseRepository {
	function __construct(User $model) {
		$this->model = $model;
	}

	public function update($id, $data) {
		$model = $this->model->findOrFail($id);

		return $model->update($data);
	}

}