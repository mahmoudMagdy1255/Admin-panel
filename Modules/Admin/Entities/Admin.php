<?php

namespace Modules\Admin\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable {
    use HasRoles;

    protected $guard_name = 'admin';

	protected $fillable = ['full_name', 'email', 'password', 'image'];

	protected $hidden = ['remeber_token', 'password'];

	public function getImageAttribute($image) {
		return 'public/upload/admins/' . $image;
	}

}
