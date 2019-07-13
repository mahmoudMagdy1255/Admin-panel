<?php

namespace Modules\Config\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigStoreFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [];

		foreach (config('translatable.locales') as $lang):

			$rules += [$lang . '.*' => 'required'];

			$rules += [$lang . '.title' => 'required'];

			$rules += [$lang . '.desc' => 'required'];

			$rules += [
				'phone' => 'required|digits_between:7,15',
				'logo' => 'sometimes|nullable|image',
				'background' => 'sometimes|nullable|image',
			];

		endforeach;

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
