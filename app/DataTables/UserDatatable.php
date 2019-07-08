<?php

namespace App\DataTables;

use Modules\User\Repositories\UserRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'user::datatables.control')
			->addColumn('image', 'user::datatables.image')
			->rawColumns(['control', 'image']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(UserRepository $userRepository) {
		return $userRepository->query();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('adminpanel::adminpanel.all')]],
				'buttons' => [
					[
						'text' => trans('adminpanel::adminpanel.add_new'),
						'className' => 'btn btn-info',
						'action' => "function(){
                                    window.location.href ='" . URL::Current() . "/create';
                                }",
					],
				],
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name' => 'id',
				'data' => 'id',
				'title' => trans('user::user.id'),
			],
			[
				'name' => 'full_name',
				'data' => 'full_name',
				'title' => trans('user::user.full_name'),
			],
			[
				'name' => 'email',
				'data' => 'email',
				'title' => trans('user::user.email'),
			],
			[
				'name' => 'image',
				'data' => 'image',
				'title' => trans('user::user.image'),
				'printable' => false,
				'searchable' => false,
				'orderable' => false,
			],

			[
				'name' => 'control',
				'data' => 'control',
				'title' => trans('adminpanel::adminpanel.control'),
				'printable' => false,
				'searchable' => false,
				'orderable' => false,
			],

		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'User_' . date('YmdHis');
	}
}
