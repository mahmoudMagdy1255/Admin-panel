<?php

namespace Modules\Trip\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Trip\Http\Requests\AlbumStoreFormRequest;
use Modules\Trip\Repositories\TripAlbumRepository;
use Modules\Trip\Repositories\TripRepository;

class TripAlbumsController extends Controller {
	use LocalFiles;

	private $destinationRepository;

	public function __construct(TripAlbumRepository $tripAlbumRepository, TripRepository $tripRepository) {
		$this->tripAlbumRepository = $tripAlbumRepository;
		$this->tripRepository = $tripRepository;

	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create($id) {

		$trip = $this->tripRepository->findOrFail($id);

		$title = trans('adminpanel::adminpanel.add_new');

		return view('trip::albums.create', compact('title', 'trip'))->with('success', session('success'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(AlbumStoreFormRequest $request) {

		$data = $request->validated();

		$imageData = $this->storeFile('image', 'trips/trips/albums', true);

		$data = array_merge($data, $imageData);

		$data = array_filter($data);

		return $this->tripAlbumRepository->create($data)->id;

	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy() {
		$id = request('id');

		$this->tripAlbumRepository->destroy($id);

	}
}
