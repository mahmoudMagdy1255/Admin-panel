<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;

class ConfigTranslation extends Model {
	protected $fillable = ['title', 'desc', 'address'];

	public $timestamps = false;
}
