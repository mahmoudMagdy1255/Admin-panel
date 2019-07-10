<?php

namespace Modules\Trip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TripCategoryUpdateFormRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {

		$rules = [];

		foreach (config('translatable.locales') as $lang):

			$rules += [$lang . '.*' => 'required'];

			$rules += [$lang . '.title' => ['required', Rule::unique('trip_category_translations', 'title')->ignore(request('id'), 'trip_category_id')]];

			$rules += [$lang . '.desc' => ['required', Rule::unique('trip_category_translations', 'desc')->ignore(request('id'), 'trip_category_id')]];
		endforeach;

		$array = [
			'image' => 'sometimes|nullable|image',
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
