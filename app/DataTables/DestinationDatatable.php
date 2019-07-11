<?php

namespace App\DataTables;

use Modules\Trip\Repositories\DestinationRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class DestinationDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'trip::destinations.datatables.control')
			->addColumn('short_desc', 'trip::destinations.datatables.short_desc')
			->addColumn('image', 'trip::destinations.datatables.image')
			->rawColumns(['control', 'image', 'short_desc']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(DestinationRepository $serviceRepository) {
		return $serviceRepository->query();
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
				'title' => trans('trip::destination.id'),
			],
			[
				'name' => 'title',
				'data' => 'title',
				'title' => trans('trip::destination.title'),
			],
			[
				'name' => 'short_desc',
				'data' => 'short_desc',
				'title' => trans('trip::destination.short_desc'),
			],
			[
				'name' => 'image',
				'data' => 'image',
				'title' => trans('trip::destination.image'),
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
		return 'Service_' . date('YmdHis');
	}
}
