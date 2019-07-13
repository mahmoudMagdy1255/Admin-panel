<?php

namespace Modules\Config\Repositories;

use App\Repositories\BaseRepository;
use Modules\Config\Entities\Config;

class ConfigRepository extends BaseRepository {
	function __construct(Config $model) {
		$this->model = $model;
	}

}