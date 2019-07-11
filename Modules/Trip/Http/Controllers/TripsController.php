<?php

namespace Modules\Trip\Http\Controllers;

use App\DataTables\TripDatatable;
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
		$trip = $this->tripRepository->find($id);

		$categories = $this->tripCategRepository->all();
		$destinations = $this->destinationRepository->all();

		$title = trans('adminpanel::adminpanel.edit');

		return view('trip::trips.edit', compact('trip', 'title', 'categories', 'destinations'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  Request $request
	 * @return Response
	 */
	public function update(TripUpdateFormRequest $request, $id) {
		$data = $request->validated();

		$trip = $this->tripRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($trip->image, 'image', 'trips/trips');

		$data = array_filter($data);

		$this->tripRepository->update($trip, $data);

		return redirect()->route('trips.index')->with('success', trans('adminpanel::adminpanel.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @return Response
	 */
	public function destroy($id) {
		$trip = $this->tripRepository->find($id);

		$this->tripRepository->destroy($id);

		$this->deleteFile($trip->image);

		return back()->with('success', trans('adminpanel::adminpanel.deleted'));
	}

}
