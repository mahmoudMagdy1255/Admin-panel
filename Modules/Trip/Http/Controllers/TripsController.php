<?php

namespace Modules\Trip\Http\Controllers;

use App\DataTables\TripDatatable;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Trip\Http\Requests\TripStoreFormRequest;
use Modules\Trip\Http\Requests\TripUpdateFormRequest;
use Modules\Trip\Repositories\DestinationRepository;
use Modules\Trip\Repositories\TripAlbumRepository;
use Modules\Trip\Repositories\TripCategoryRepository;
use Modules\Trip\Repositories\TripRepository;
use Yajra\DataTables\Facades\DataTables;

class TripsController extends Controller {
	use LocalFiles;

	public function __construct(DestinationRepository $destinationRepository, TripRepository $tripRepository, TripAlbumRepository $tripPicRepository, TripCategoryRepository $tripCategRepository) {
		$this->tripRepository = $tripRepository;
		$this->tripCategRepository = $tripCategRepository;
		$this->tripPicRepository = $tripPicRepository;
		$this->destinationRepository = $destinationRepository;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(TripDatatable $tripDatatable) {

		$title = trans('trip::trip.trips');
		return $tripDatatable->render('trip::trips.index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$title = trans('adminpanel::adminpanel.add_new');
		$categories = $this->tripCategRepository->all();
		$destinations = $this->destinationRepository->all();

		return view('trip::trips.create', compact('title', 'categories', 'destinations'));
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

		return view('trip::Trip.show', ['trip' => $trip]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function store(TripStoreFormRequest $request) {

		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'trips/trips');
		$data = array_filter($data);

		$trip = $this->tripRepository->create($data);

		$this->tripRepository->addCategories($trip, $data['categories']);
		$this->tripRepository->addDestinations($trip, $data['destinations']);

		return redirect()->route('trips.trip-albums.create', $trip)->with('success', trans('trip::trip.created_and_continue_to_choose_album'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @return Response
	 */
	public function edit($id) {
		$selected_categ_ids = [];

		$trip = $this->tripRepo->find($id);

		$categories = $this->categRepo->findAll();
		$destinations = $this->destinationRepository->findAll();

		if (isset($trip->destinations)) {
			foreach ($trip->destinations as $value) {
				$selected_categ_ids[] = $value->id;
			}
		}

		return view('trip::Trip.edit', [
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
	public function update(TripUpdateFormRequest $request, $id) {
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
