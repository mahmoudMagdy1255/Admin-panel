<?php

namespace Modules\TripModule\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TripModule\Repository\DestinationRepository;
use Modules\TripModule\Repository\TripCategoryRepository;
use Modules\TripModule\Repository\TripPhotosRepository;
use Modules\TripModule\Repository\TripRepository;
use Yajra\DataTables\Facades\DataTables;

class TripsController extends Controller {
	use UploaderHelper;

	private $tripRepo, $categRepo, $tripPicRepo, $destinationRepo;

	public function __construct(DestinationRepository $destinationRepo, TripRepository $tripRepo, TripPhotosRepository $tripPicRepo, TripCategoryRepository $categRepo) {
		$this->tripRepo = $tripRepo;
		$this->categRepo = $categRepo;
		$this->tripPicRepo = $tripPicRepo;
		$this->destinationRepo = $destinationRepo;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index() {
		$trips = $this->tripRepo->findAll();

		return view('tripmodule::Trip.index', ['trips' => $trips]);
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$categs = $this->categRepo->findAll();
		$destinations = $this->destinationRepo->findAll();

		return view('tripmodule::Trip.create', ['categs' => $categs, 'destinations' => $destinations]); //, 'trip' => $trip
	}

	/**
	 * Show specified resource.
	 *
	 * @param int $id
	 *
	 * @return response
	 */
	public function show($id) {
		$trip = $this->tripRepo->find($id);

		return view('tripmodule::Trip.show', ['trip' => $trip]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function store(Request $request) {
		$tripData = $request->except('_token', 'photo', 'photos', 'destinations', 'trip_category_id');
		$tripDestinations = $request->get('destinations');
		$tripCategoriesId = $request->get('trip_category_id');

		if ($request->hasFile('photo')) {
			$image = $request->file('photo');
			$imageName = $this->upload($image, 'trip', true); // resize option executed.
			$tripData['photo'] = $imageName;
		}

		# Loop through product_photos_many to save photos first.
		$trip_pics = [];
		if ($request->hasFile('photos')) {
			$photos = $request->file('photos');
			$trip_pics = $this->uploadAlbum($photos, 'trips');
		}

//        dd($tripData , $trip_pics , $tripDestinations , $tripCategoriesId);

		$this->tripRepo->save($tripData, $trip_pics, $tripDestinations, $tripCategoriesId);

		return redirect('admin-panel/trip')->with('success', 'success');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @return Response
	 */
	public function edit($id) {
		$selected_categ_ids = [];

		$trip = $this->tripRepo->find($id);

		$categories = $this->categRepo->findAll();
		$destinations = $this->destinationRepo->findAll();

		if (isset($trip->destinations)) {
			foreach ($trip->destinations as $value) {
				$selected_categ_ids[] = $value->id;
			}
		}

		return view('tripmodule::Trip.edit', [
			'trip' => $trip,
			'categs' => $categories,
			'selected_categ_ids' => $selected_categ_ids,
			'destinations' => $destinations,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$tripPic = $this->tripRepo->find($id);
		$tripData = $request->except('_token', '_method', 'photo', 'photos', 'de', 'en', 'es', 'ru', 'fr', 'it', 'destinations', 'categories');

		$activeLangCode = \LanguageHelper::getDynamicLangCode();

		$trip_trans = $request->only($activeLangCode);

		$tripDestinations = $request->get('destinations');
		$tripCategories = $request->get('categories');

		if ($request->hasFile('photo')) {
			// Delete old image first.
			$thumbnail_path = public_path() . '/images/trip/thumb/' . $tripPic->photo;
			$thumbnail_path2 = public_path() . '/images/trip/' . $tripPic->photo;
			File::delete([$thumbnail_path, $thumbnail_path2]);

			// Save the new one.
			$image = $request->file('photo');
			$imageName = $this->upload($image, 'trip', true); // resize option executed.
			$tripData['photo'] = $imageName;
		}

		$this->tripRepo->update($id, $tripData, $trip_trans, $tripDestinations, $tripCategories);

		return redirect('admin-panel/trip')->with('updated', 'updated');
	}

	/**
	 * Update Album Photos
	 *
	 * @param   Request  $request  [$request description]
	 *
	 * @return  [type]             [return description]
	 */
	public function storeAlbum(Request $request) {
		$tripData = $request->except('_token', 'photos');

		# Loop through product_photos_many to save photos first.
		$trip_pics = [];
		if ($request->hasFile('photos')) {
			$photos = $request->file('photos');
			$trip_pics = $this->uploadAlbum($photos, 'trips');
		}

		$this->tripRepo->updateAlbumPhotos($tripData, $trip_pics);

		return redirect('admin-panel/trip')->with('updated', 'updated');
	}

	/**
	 * Remove the specified resource from storage.
	 * @return Response
	 */
	public function destroy($id) {
		$trip = $this->tripRepo->find($id);

		# Get The trip photo album, then pass it to repo to delete it
		$this->tripPicRepo->delete($trip);

		# Delete the Main photo and Thumbnail.
		$this->tripRepo->delete($trip);

		return redirect()->back();
	}

	public function dataTables() {
		$trips = $this->tripRepo->findAll();

		return DataTables::of($trips)
			->addColumn('name', function ($row) {
				return substr($row->title, 0, 60);
			})
			->addColumn('price', function ($row) {
				return $row->price;
			})
			->addColumn('category', function ($row) {
				$categories = '';

				foreach ($row->categories as $category) {

					$categories .= $category->title . ' , ';

				}

				return rtrim($categories, ', ');
			})
			->addColumn('destination', function ($row) {

				$desArr = [];
				foreach ($row->destinations as $des) {
					$desArr[] = $des->title;
				}

				return $desArr;

			})
			->addColumn('days', function ($row) {
				return $row->days;

			})
			->addColumn('photo', function ($row) {
				if ($row->photo) {
					return '<img width="150px" height="50px" src=' . asset("public/images/trip/thumb/" . $row->photo) . '/>';
				} else {
					return '<strong> No Photo </strong>';
				}
			})
			->addColumn('operations', function ($row) {
				$delete_tag = '<a href="' . url('admin-panel/trip/delete', $row->id) . '" class="btn btn btn-danger" onclick="return confirm(\'Are you sure, You want to delete this Data?\')"><i class="glyphicon glyphicon-trash"></i></a>';
				$edit_tag = '<a href="' . url("admin-panel/trip/" . $row->id . "/edit") . '" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
				$show_tag = '<a href="' . url("admin-panel/trip/" . $row->id) . '" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
				$prog_tag = '<a href="' . url("admin-panel/trip-program/" . $row->id) . '" type="button" class="btn btn-warning"><i class="fa fa-map" aria-hidden="true"></i></a>';

				return $prog_tag . ' &nbsp; ' . $show_tag . ' &nbsp; ' . $edit_tag . ' &nbsp; ' . $delete_tag;
			})

			->rawColumns(['delete' => 'delete', 'operations' => 'operations', 'program' => 'program', 'photo' => 'photo'])
			->make(true);
	}

	/**
	 * Delete Specific photo from the Album.
	 *
	 * @param   [type]  $id  [$id description]
	 *
	 * @return  [type]       [return description]
	 */
	public function deletePic($id) {
		$this->tripPicRepo->deletePic($id);
		return redirect()->back();
	}
}
