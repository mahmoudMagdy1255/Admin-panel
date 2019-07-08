<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'full_name' => 'required|min:3',
			'email' => 'required|email|unique:users,email,' . request('id'),
			'password' => 'sometimes|nullable|min:5',
			'image' => 'sometimes|nullable|image',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
}
