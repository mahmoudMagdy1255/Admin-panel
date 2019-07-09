<?php

namespace Modules\Service\Http\Controllers;

use App\DataTables\ServiceDatatable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Service\Http\Requests\ServiceStoreFormRequest;
use Modules\Service\Http\Requests\ServiceUpdateFormRequest;
use Modules\Service\Repositories\ServiceRepository;

class servicesController extends Controller {
	use LocalFiles;
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function __construct(ServiceRepository $serviceRepository) {
		$this->serviceRepository = $serviceRepository;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */

	public function index(ServiceDatatable $serviceDatatable) {
		$title = trans('service::service.services');
		return $serviceDatatable->render('service::services.index', compact('title'));

	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {

		$title = trans('adminpanel::adminpanel.add_new');

		return view('service::services.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(ServiceStoreFormRequest $request) {
		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'services/services');
		$data = array_filter($data);

		$this->serviceRepository->create($data);

		return redirect()->route('services.index')->with('success', trans('adminpanel::adminpanel.created'));
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
		$service = $this->serviceRepository->find($id);
		$title = trans('adminpanel::adminpanel.edit');

		return view('service::services.edit', compact('service', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(ServiceUpdateFormRequest $request, $id) {
		$data = $request->validated();

		$service = $this->serviceRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($service->image, 'image', 'services/services');

		$data = array_filter($data);

		$this->serviceRepository->update($id, $data);

		return redirect()->route('services.index')->with('success', trans('adminpanel::adminpanel.updated'));

	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$service = $this->serviceRepository->findOrFail($id);
		$this->serviceRepository->destroy($id);
		$this->deleteFile($service->image);
		return back()->with('success', trans('adminpanel::adminpanel.deleted'));

	}
}
