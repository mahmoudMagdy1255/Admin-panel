<?php

namespace Modules\Trip\Http\Controllers;

use App\DataTables\TripCategoryDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Trip\Http\Requests\TripCategoryStoreFormRequest;
use Modules\Trip\Http\Requests\TripCategoryUpdateFormRequest;
use Modules\Trip\Repositories\TripCategoryRepository;

class TripCategoriesController extends Controller {
	use LocalFiles;
	private $tripCategoryRepository;

	public function __construct(TripCategoryRepository $tripCategoryRepository) {
		$this->tripCategoryRepository = $tripCategoryRepository;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(TripCategoryDatatable $tripCategoryDatatable) {
		$title = trans('trip::category.categories');
		return $tripCategoryDatatable->render('trip::categories.index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$title = trans('adminpanel::adminpanel.add_new');
		return view('trip::categories.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function store(TripCategoryStoreFormRequest $request) {

		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'trips/categories');
		$data = array_filter($data);

		$this->tripCategoryRepository->create($data);

		return redirect()->route('trip-categories.index')->with('success', trans('adminpanel::adminpanel.created'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @return Response
	 */
	public function edit($id) {
		$category = $this->tripCategoryRepository->find($id);
		$title = trans('adminpanel::adminpanel.edit');

		return view('trip::categories.edit', compact('category', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function update($id, TripCategoryUpdateFormRequest $request) {
		$data = $request->validated();

		$category = $this->tripCategoryRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($category->image, 'image', 'trips/categories');

		$data = array_filter($data);

		$this->tripCategoryRepository->update($id, $data);

		return redirect()->route('trip-categories.index')->with('success', trans('adminpanel::adminpanel.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @return Response
	 */
	public function destroy($id) {

		$this->destroySubCategories($id);
		return back()->with('success', trans('adminpanel::adminpanel.deleted'));

	}

	public function destroySubCategories($id) {
		$sub_categories = $this->tripCategoryRepository->where('parent_id', $id)->get();

		foreach ($sub_categories as $sub) {

			$this->destroySubCategories($sub->id);
			$this->deleteFile($sub->image);
			$this->tripCategoryRepository->destroy($sub->id);
		}

		$category = $this->tripCategoryRepository->find($id);
		$this->deleteFile($category->image);
		$this->tripCategoryRepository->destroy($category->id);

	}

}
