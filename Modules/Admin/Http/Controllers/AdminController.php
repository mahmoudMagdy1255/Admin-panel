<?php

namespace Modules\Admin\Http\Controllers;

use App\DataTables\AdminDatatable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\AdminStoreFormRequest;
use Modules\Admin\Http\Requests\AdminUpdateFormRequest;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Common\Services\LocalFiles;

class AdminController extends Controller {

	use LocalFiles;

	public function __construct(AdminRepository $adminRepository) {
		$this->adminRepository = $adminRepository;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(AdminDatatable $adminDatatable) {
		$title = trans('admin::admin.admins');

		return $adminDatatable->render('admin::index', compact('title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create() {
		$title = trans('adminpanel::adminpanel.add_new');
		return view('admin::create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Response
	 */
	public function store(AdminStoreFormRequest $request) {

		$data = $request->validated();

		$data['image'] = $this->storeFile('image', 'admins');
		$data = array_filter($data);

		$this->adminRepository->create($data);

		return redirect()->route('admins.index')->with('success', trans('adminpanel::adminpanel.created'));

	}

	/**
	 * Show the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		return view('admin::show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {

		$title = trans('adminpanel::adminpanel.edit');
		$admin = $this->adminRepository->find($id);

		return view('admin::edit', compact('admin', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(AdminUpdateFormRequest $request, $id) {

		$data = $request->validated();

		$admin = $this->adminRepository->find($id);

		$data['image'] = $this->deleteAndStoreNewFile($admin->image, 'image', 'admins');

		$data = array_filter($data);

		$this->adminRepository->update($id, $data);

		return redirect()->route('admins.index')->with('success', trans('adminpanel::adminpanel.updated'));

	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {

		$admin = $this->adminRepository->find($id);
		$this->adminRepository->destroy($admin->id);
		$this->deleteFile($admin->image);

		return back()->with('success', trans('adminpanel::adminpanel.deleted'));
	}

    public function delete_all(Request $request)
    {
        if (!$request->has('check_this')){
            return back()->with('warning', trans('adminpanel::adminpanel.choose_first'));
        }else {
            if (is_array($request->check_this)) {
                foreach ($request->check_this as $id) {
                    $admin = $this->adminRepository->find($id);
                    $this->adminRepository->destroy($admin->id);
                    $this->deleteFile($admin->image);
                    return back()->with('success', trans('adminpanel::adminpanel.deleted'));
                }
            }else{
                $admin = $this->adminRepository->find($request->check_this);
                $this->adminRepository->destroy($admin->id);
                $this->deleteFile($admin->image);
                return back()->with('success', trans('adminpanel::adminpanel.deleted'));
            }
        }
	}
}
