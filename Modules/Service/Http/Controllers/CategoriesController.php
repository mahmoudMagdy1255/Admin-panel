<?php

namespace Modules\Service\Http\Controllers;

use App\DataTables\ServiceCategoryDatatable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Service\Http\Requests\ServiceCategoryStoreFormRequest;
use Modules\Service\Http\Requests\ServiceCategoryUpdateFormRequest;
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
	public function store(ServiceCategoryStoreFormRequest $request) {
		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'services/categories');
		$data = array_filter($data);

		$this->serviceCategoryRepository->create($data);

		return redirect()->route('service-categories.index')->with('success', trans('adminpanel::adminpanel.created'));
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
		$category = $this->serviceCategoryRepository->find($id);
		$title = trans('adminpanel::adminpanel.edit');

		return view('service::categories.edit', compact('category', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(ServiceCategoryUpdateFormRequest $request, $id) {
		$data = $request->validated();

		$category = $this->serviceCategoryRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($category->image, 'image', 'services/categories');

		$data = array_filter($data);

		$this->serviceCategoryRepository->update($id, $data);

		return redirect()->route('service-categories.index')->with('success', trans('adminpanel::adminpanel.updated'));

	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$this->destroySubCategories($id);
		return back()->with('success', trans('adminpanel::adminpanel.deleted'));

	}

	public function destroySubCategories($id) {
		$sub_categories = $this->serviceCategoryRepository->where('parent_id', $id)->get();

		foreach ($sub_categories as $sub) {

			$this->destroySubCategories($sub->id);
			$this->deleteFile($sub->image);
			$this->serviceCategoryRepository->delete($sub);
		}

		$category = $this->serviceCategoryRepository->find($id);
		$this->deleteFile($category->image);
		$this->serviceCategoryRepository->delete($category);

	}
}
