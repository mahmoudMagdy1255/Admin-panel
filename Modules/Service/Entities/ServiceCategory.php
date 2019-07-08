<?php

namespace Modules\Service\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model {

	use Translatable;

	protected $tanslatedAttributes = ['title', 'desc'];

	protected $fillable = ['image', 'parent_id'];
}
