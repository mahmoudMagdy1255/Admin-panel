<?php

namespace Modules\Trip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TripStoreFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [
			'title' => 'required|min:3|max:32',
			'desc' => 'required|min:3',
			'image' => 'required|image',
			'categories' => 'required|array',
			'destinations' => 'required|array',
			'user_id' => 'required|exists:users,id',
			'price' => 'required|numeric|min:1|max:1000000',
			'days' => 'required|numeric|min:1|max:60',
			'include' => 'sometimes|nullable',
			'not_include' => 'sometimes|nullable',
			'note' => 'sometimes|nullable',
		];

		return $rules;
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
