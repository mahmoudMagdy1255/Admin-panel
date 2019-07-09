<?php

namespace Modules\TripModule\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TripModule\Repository\TripCategoryRepository;
use Yajra\DataTables\DataTables;

class TripCategoryController extends Controller {
	use UploaderHelper;
	private $categRepo;

	public function __construct(TripCategoryRepository $categRepo) {
		$this->categRepo = $categRepo;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index() {
		$categs = $this->categRepo->findAll();
		return view('tripmodule::TripCategory.index', ['categs' => $categs]);
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$categs = $this->categRepo->findAll();
		return view('tripmodule::TripCategory.create', ['categories' => $categs]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function store(Request $request) {
		if ($request->parent_id == 0) {
			$categoryData = $request->except('_token', 'cover_photo', 'photo', 'parent_id');
		} else {
			$categoryData = $request->except('_token', 'cover_photo', 'photo');
		}

		if ($request->hasFile('photo')) {
			$image = $request->file('photo');
			$imageName = $this->upload($image, 'trip_category', true);
			$categoryData['photo'] = $imageName;
		}
		if ($request->hasFile('cover_photo')) {
			$image = $request->file('cover_photo');
			$imageName = $this->upload($image, 'trip_category');
			$categoryData['cover_photo'] = $imageName;
		}

		$this->categRepo->store($categoryData);

		return redirect('admin-panel/trip/category')->with('success', 'success');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @return Response
	 */
	public function edit($id) {
		$category = $this->categRepo->find($id);
		$categories = $this->categRepo->findAll();

		return view('tripmodule::TripCategory.edit', ['categ' => $category, 'categs' => $categories]);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function update($id, Request $request) {
		// dd($request->all());
		$category_pic = $this->categRepo->find($id);

		if ($request->parent_id == 0) {
			$category = $request->except('_token', '_method', 'parent_id', 'ar', 'en');
		} else {
			$category = $request->except('_token', '_method', 'ar', 'en');
		}

		$activeLangCode = \LanguageHelper::getDynamicLangCode();

		$categ_trans = $request->only($activeLangCode);

		if ($request->hasFile('photo')) {
			// Delete old image first.
			$thumb_path = public_path() . 'images/trip_category/thumb' . $category_pic->photo;
			File::delete($thumb_path);

			// Store the new pic.
			$image = $request->file('photo');
			$imageName = $this->upload($image, 'trip_category');
			$category['photo'] = $imageName;
		}

		if ($request->hasFile('cover_photo')) {
			// Delete old cover image first.
			$thumb_path = public_path() . 'images/trip_category/' . $category_pic->cover_photo;
			File::delete($thumb_path);

			// Store the new pic.
			$image = $request->file('cover_photo');
			$imageName = $this->upload($image, 'trip_category');
			$category['cover_photo'] = $imageName;
		}

		$category = $this->categRepo->update($id, $category, $categ_trans);

		return redirect('admin-panel/trip/category')->with('updated', 'updated');
	}

	/**
	 * Remove the specified resource from storage.
	 * @return Response
	 */
	public function destroy($id) {
		$this->categRepo->delete($id);
		return redirect()->back();
	}

	public function dataTables() {
		$categories = $this->categRepo->findAll();

		return DataTables::of($categories)
			->addColumn('name', function ($row) {
				return $row->title;
			})
			->addColumn('edit', function ($row) {
				return '<a href="' . url("admin-panel/trip/category/" . $row->id . "/edit") . '" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
			})
			->addColumn('photo', function ($row) {
				if ($row->photo) {
					return '<img width="200px" height="80px" src=' . asset("public/images/trip_category/" . $row->photo) . '/>';
				} else {
					return '<strong> No Photo </strong>';
				}
			})
			->addColumn('delete', function ($row) {
				return '<a href="' . url('admin-panel/trip/category/delete', $row->id) . '" class="btn btn btn-danger" data-confirm="Are you sure, You want to delete?" data-method="delete"><i class="glyphicon glyphicon-trash"></i></a>';
			})
			->rawColumns(['delete' => 'delete', 'edit' => 'edit', 'photo' => 'photo'])
			->make(true);
	}
}
