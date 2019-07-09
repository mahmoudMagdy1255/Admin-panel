<?php

$serviceCategoryRespository = resolve('Modules\Service\Repositories\ServiceCategoryRepository');

if (!function_exists('load_services_categories')) {
	function load_services_categories() {

		$categories = $serviceCategoryRespository->all();

		$cats_array = [];

		foreach ($categories as $category) {

			$cat_array = [];
			$cat_array['icon'] = '';
			$cat_array['li_attr'] = '';
			$cat_array['a_attr'] = '';
			$cat_array['children'] = '';

			$cat_array['id'] = $category->id;
			$cat_array['text'] = $category->title;
			$cat_array['text'] = $category->parent_id ?: '#';

			array_push($cats_array, $cat_array);

		}

		return $cats_array;

	}
}