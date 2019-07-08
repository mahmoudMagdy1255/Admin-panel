<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	protected $fillable = ['full_name', 'email', 'password', 'image'];

	protected $hidden = ['remeber_token', 'password'];

	public function getImageAttribute($image) {
		return 'public/upload/users/' . $image;
	}
}
