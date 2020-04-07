<?php

namespace App\DataTables;

use App\Opponent;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OpponentsDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			->addColumn('action', 'opponents.action');
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Opponent $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Opponent $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('users-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(1)
			->buttons(
				Button::make('create'),
				Button::make('export'),
				Button::make('print'),
				Button::make('reset'),
				Button::make('reload')
			);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-center'),
			Column::make('id'),
			Column::make('name'),
			Column::make('status'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Opponents_' . date('YmdHis');
	}
}
