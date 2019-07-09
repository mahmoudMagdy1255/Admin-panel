<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceUpdateFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [
			'title' => 'required|min:3|max:32',
			'desc' => 'required|min:3',
			'image' => 'nullable|sometimes|image',
			'category_id' => 'required|exists:service_categories,id',
			'user_id' => 'required|numeric',
			'price' => 'required|numeric|min:1|max:1000000',
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
