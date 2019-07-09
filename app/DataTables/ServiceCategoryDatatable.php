<?php

namespace App\DataTables;

use Modules\Service\Repositories\ServiceCategoryRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class ServiceCategoryDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'service::categories.datatables.control')
			->addColumn('image', 'service::categories.datatables.image')
			->addColumn('desc', 'service::categories.datatables.desc')
			->rawColumns(['control', 'image', 'desc']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(ServiceCategoryRepository $serviceCategoryRepository) {
		return $serviceCategoryRepository->query();
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
						'text' => trans('adminpanel::adminpanel.add'),
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
				'title' => trans('service::category.id'),
			],
			[
				'name' => 'title',
				'data' => 'title',
				'title' => trans('service::category.title'),
			],
			[
				'name' => 'desc',
				'data' => 'desc',
				'title' => trans('service::category.desc'),
			],
			[
				'name' => 'image',
				'data' => 'image',
				'title' => trans('service::category.image'),
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
