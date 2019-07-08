<?php

namespace Modules\Service\Http\Controllers;

use App\DataTables\ServiceCategoryDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Service\Repositories\ServiceCategoryRepository;

class CategoriesController extends Controller {
	use LocalFiles;
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function __construct(ServiceCategoryRepository $serviceCategoryRepository) {
		$this->serviceCategoryRepository = $serviceCategoryRepository;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */

	public function index(ServiceCategoryDatatable $serviceCategoryDatatable) {
		$title = trans('service::category.categories');
		return $serviceCategoryDatatable->render('service::categories.index', compact('title'));

	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {

		$title = trans('adminpanel::adminpanel.add_new');

		return view('service::categories.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Show the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		return view('service::show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		return view('service::edit');
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}
}
