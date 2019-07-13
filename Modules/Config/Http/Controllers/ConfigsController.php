<?php

namespace Modules\Config\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\Config\Http\Requests\ConfigStoreFormRequest;
use Modules\Config\Repositories\ConfigRepository;

class ConfigsController extends Controller {

	use LocalFiles;
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function __construct(ConfigRepository $configRepository) {
		$this->configRepository = $configRepository;
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index() {

		$title = trans('config::config.configs');

		$config = $this->configRepository->latest()->first();

		return view('config::index', compact('title', 'config'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		return view('config::create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(ConfigStoreFormRequest $request) {

		$data = $request->validated();

		$config = $this->configRepository->latest()->first();

		$data = array_filter($data);

		if ($config) {
			$data['background'] = $this->deleteAndStoreNewFile($config->background, 'background', 'configs');
			$data['logo'] = $this->deleteAndStoreNewFile($config->logo, 'logo', 'configs');

			$this->configRepository->latest()->first()->update($data);

			$message = trans('adminpanel::adminpanel.updated');

		} else {

			$data['background'] = $this->storeFile('image', 'configs');
			$data['logo'] = $this->storeFile('image', 'configs');
			$this->configRepository->create($data);

			$message = trans('adminpanel::adminpanel.created');
		}

		return back()->with('success', $message);
	}

	/**
	 * Show the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		return view('config::show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		return view('config::edit');
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}
}
