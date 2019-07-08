<?php

namespace Modules\User\Http\Controllers;

use App\DataTables\UserDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Services\LocalFiles;
use Modules\User\Http\Requests\UserStoreFormRequest;
use Modules\User\Http\Requests\UserUpdateFormRequest;
use Modules\User\Repositories\UserRepository;

class UsersController extends Controller {
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */

	use LocalFiles;

	public function __construct(UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */

	public function index(UserDatatable $userDatatable) {
		$title = trans('user::user.users');
		return $userDatatable->render('user::index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$title = trans('adminpanel::adminpanel.add_new');

		return view('user::create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(UserStoreFormRequest $request) {
		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'users');
		$data = array_filter($data);

		$this->userRepository->create($data);

		return redirect()->route('users.index')->with('success', trans('adminpanel::adminpanel.created'));
	}

	/**
	 * Show the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		return view('user::show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$title = trans('adminpanel::adminpanel.edit');
		$user = $this->userRepository->find($id);

		return view('user::edit', compact('user', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(UserUpdateFormRequest $request, $id) {
		$data = $request->validated();

		$user = $this->userRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($user->image, 'image', 'users');

		$data = array_filter($data);

		$this->userRepository->update($id, $data);

		return redirect()->route('users.index')->with('success', trans('adminpanel::adminpanel.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$user = $this->userRepository->find($id);
		$this->userRepository->destroy($user->id);
		$this->deleteFile($user->image);

		return back()->with('success', trans('adminpanel::adminpanel.deleted'));
	}
}
