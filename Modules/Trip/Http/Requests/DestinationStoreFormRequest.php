<?php

namespace Modules\Trip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestinationStoreFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [];

		foreach (config('translatable.locales') as $lang):

			$rules += [$lang . '.*' => 'required'];

			$rules += [$lang . '.title' => ['required', Rule::unique('destination_translations', 'title')]];

			$rules += [$lang . '.desc' => ['required', Rule::unique('destination_translations', 'desc')]];
		endforeach;

		$array = [
			'image' => 'required|image',
			'parent_id' => 'sometimes|nullable',
		];

		$rules = array_merge($rules, $array);

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
