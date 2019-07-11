<?php

namespace App\DataTables;

use Modules\Service\Repositories\ServiceRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class ServiceDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'service::services.datatables.control')
			->addColumn('short_desc', 'service::services.datatables.short_desc')
			->addColumn('image', 'service::services.datatables.image')
			->rawColumns(['control', 'image', 'short_desc']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(ServiceRepository $serviceRepository) {
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
				'title' => trans('service::service.id'),
			],
			[
				'name' => 'title',
				'data' => 'title',
				'title' => trans('service::service.title'),
			],
			[
				'name' => 'short_desc',
				'data' => 'short_desc',
				'title' => trans('service::service.short_desc'),
			],
			[
				'name' => 'price',
				'data' => 'price',
				'title' => trans('service::service.price'),
			],
			[
				'name' => 'image',
				'data' => 'image',
				'title' => trans('service::service.image'),
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
