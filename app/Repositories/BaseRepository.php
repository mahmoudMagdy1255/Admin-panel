<?php

namespace App\Repositories;

class BaseRepository {

	public function __call($method, $args) {
		return $this->model->$method(...$args);
	}
}