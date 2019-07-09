<?php

namespace Modules\TripModule\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\TripModule\Repository\DestinationRepository;

class DestinationController extends Controller {
	use UploaderHelper;

	private $destinationRepo;

	public function __construct(DestinationRepository $destinationRepo) {
		$this->destinationRepo = $destinationRepo;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index() {
		$destinations = $this->destinationRepo->findAll();

		return view('tripmodule::destination.index', ['destinations' => $destinations]);
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$destinations = $this->destinationRepo->findAll();

		return view('tripmodule::destination.create', ['destinations' => $destinations]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request) {
		$data = $request->except('_token');

		if ($request->hasFile('photo')) {
			$image = $request->file('photo');
			$imageName = $this->uploadWithResize($image, 'destination', 800, 960);
			$data['photo'] = $imageName;
		}

		$this->destinationRepo->save($data);

		return redirect('/admin-panel/destination')->with('success', 'success');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$destination = $this->destinationRepo->find($id);
		$destinations = $this->destinationRepo->findAll($id);

		return view('tripmodule::destination.edit', ['destination' => $destination, 'destinations' => $destinations]);
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$destinationPic = $this->destinationRepo->find($id);
		$destinationData = $request->except('_token', '_method', 'photo', 'it', 'fr', 'ru', 'en');

		$activeLangCode = \LanguageHelper::getDynamicLangCode();
		$destinationTrans = $request->only($activeLangCode);

		if ($request->hasFile('photo')) {
			// Delete old image first.
			$thumbnail_path = public_path() . '/images/destination/' . $destinationPic->photo;
			File::delete([$thumbnail_path]);

			// Save the new one.
			$image = $request->file('photo');
			$imageName = $this->uploadWithResize($image, 'destination', 800, 960);
			$destinationData['photo'] = $imageName;
		}

		$this->destinationRepo->update($id, $destinationData, $destinationTrans);

		return redirect('admin-panel/destination')->with('updated', 'updated');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$destination = $this->destinationRepo->find($id);
		$this->destinationRepo->delete($destination);

		return redirect()->back();
	}
}
