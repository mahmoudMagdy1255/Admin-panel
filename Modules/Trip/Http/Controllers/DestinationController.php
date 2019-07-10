<?php

namespace Modules\Trip\Http\Controllers;

use App\DataTables\DestinationDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Trip\Http\Requests\DestinationStoreFormRequest;
use Modules\Trip\Http\Requests\DestinationUpdateFormRequest;
use Modules\Trip\Repositories\DestinationRepository;

class DestinationController extends Controller {
	use LocalFiles;

	private $destinationRepository;

	public function __construct(DestinationRepository $destinationRepository) {
		$this->destinationRepository = $destinationRepository;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(DestinationDatatable $destinationDatatable) {

		$title = trans('trip::destination.destinations');
		return $destinationDatatable->render('trip::destinations.index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$title = trans('adminpanel::adminpanel.add_new');
		return view('trip::destinations.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(DestinationStoreFormRequest $request) {
		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'trips/destinations');
		$data = array_filter($data);

		$this->destinationRepository->create($data);

		return redirect()->route('destinations.index')->with('success', trans('adminpanel::adminpanel.created'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {

		$destination = $this->destinationRepository->find($id);
		$title = trans('adminpanel::adminpanel.edit');

		return view('trip::destinations.edit', compact('destination', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(DestinationUpdateFormRequest $request, $id) {

		$destination = $this->destinationRepository->find($id);

		$data = $request->validated();

		$data['image'] = $this->deleteAndStoreNewFile($destination->image, 'image', 'trips/destinations');

		$data = array_filter($data);

		$this->destinationRepository->update($destination, $data);

		return redirect()->route('destinations.index')->with('success', trans('adminpanel::adminpanel.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$this->destroySubDestinations($id);
		return back()->with('success', trans('adminpanel::adminpanel.deleted'));

	}

	public function destroySubDestinations($id) {
		$sub_destinations = $this->destinationRepository->where('parent_id', $id)->get();

		foreach ($sub_destinations as $sub) {

			$this->destroySubdestinations($sub->id);
			$this->deleteFile($sub->image);
			$this->destinationRepository->delete($sub);
		}

		$destination = $this->destinationRepository->find($id);
		$this->deleteFile($destination->image);
		$this->destinationRepository->delete($destination);

	}
}
