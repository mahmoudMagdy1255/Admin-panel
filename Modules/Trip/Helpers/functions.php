<?php

if (!function_exists('load_trips_categories')) {
	function load_trips_categories($select = null, $hide = null) {

		$tripCategoryRespository = resolve('Modules\Trip\Repositories\TripCategoryRepository');

		$categories = $tripCategoryRespository->all();

		$cats_array = [];

		foreach ($categories as $category) {

			$cat_array = [];
			$cat_array['icon'] = '';
			$cat_array['li_attr'] = '';
			$cat_array['a_attr'] = '';
			$cat_array['children'] = '';

			$cat_array['id'] = $category->id;
			$cat_array['text'] = $category->title;
			$cat_array['parent'] = $category->parent_id ?: '#';

			if ($select == $category->id) {
				$cat_array['state'] = [
					'opened' => true,
					'selected' => true,
					'disabled' => false,
				];
			}

			if ($hide == $category->id) {

				$cat_array['state'] = [
					'opened' => false,
					'selected' => false,
					'hidden' => true,
				];

			}

			array_push($cats_array, $cat_array);

		}

		return json_encode($cats_array, JSON_UNESCAPED_UNICODE);

	}
}

if (!function_exists('load_destinations')) {
	function load_destinations($select = null, $hide = null) {

		$destinationRespository = resolve('Modules\Trip\Repositories\DestinationRepository');

		$categories = $destinationRespository->all();

		$cats_array = [];

		foreach ($categories as $category) {

			$cat_array = [];
			$cat_array['icon'] = '';
			$cat_array['li_attr'] = '';
			$cat_array['a_attr'] = '';
			$cat_array['children'] = '';

			$cat_array['id'] = $category->id;
			$cat_array['text'] = $category->title;
			$cat_array['parent'] = $category->parent_id ?: '#';

			if ($select == $category->id) {
				$cat_array['state'] = [
					'opened' => true,
					'selected' => true,
					'disabled' => false,
				];
			}

			if ($hide == $category->id) {

				$cat_array['state'] = [
					'opened' => false,
					'selected' => false,
					'hidden' => true,
				];

			}

			array_push($cats_array, $cat_array);

		}

		return json_encode($cats_array, JSON_UNESCAPED_UNICODE);

	}
}