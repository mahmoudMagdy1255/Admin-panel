<?php

namespace Modules\Admin\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {
	protected $fillable = ['full_name', 'email', 'password', 'image'];

	protected $hidden = ['remeber_token', 'password'];

	public function getImageAttribute($image) {
		return 'public/upload/admins/' . $image;
	}

}
