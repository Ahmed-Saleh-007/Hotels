<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Services\DataTable;

class RoomDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'rooms.btn.checkbox')
            ->addColumn('actions', 'rooms.btn.actions')
            ->rawColumns([
                'checkbox',
                'actions',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Room::query()->with('floor')->with('floor.manager')->select('rooms.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'        => 'Blfrtip',
                        'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 100]],
                        'buttons'    => [
                            ['text'   => '<i class="fa fa-plus" style="margin-right:2px;"></i> '.trans('admin.add'), 'className' => 'btn btn-info ajax-create'],
                            ['text'   => '<i class="fa fa-trash"></i>', 'className' => 'btn btn-danger delBtn'],
                            ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fas fa-file-csv" style="margin:0 2px;"></i> '.trans('admin.ex_csv')],
                            ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fas fa-file-excel" style="margin:0 2px;"></i> '.trans('admin.ex_excel')],
                            ['extend' => 'pdfHtml5', 'className' => 'btn btn-warning', 'text' => '<i class="fas fa-file-pdf" style="margin:0 2px;"></i> '.trans('admin.ex_pdf')],
                            ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fas fa-print"></i>'],
                            ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fas fa-sync-alt"></i>'],
                        ],
                        'initComplete' => ' function () {
                            this.api().columns([1,2,3,4,5,6]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                .on("keyup", function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }',
                        'language'   => datatableLang(),
                        'responsive' => true,
                        'autoWidth'  => true,

                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        //return ['id', 'name', 'email', 'created_at', 'updated_at', 'edit', 'delete'];
        return [
            [
				'name'          => 'checkbox',
				'data'          => 'checkbox',
				'title'         => '<input type="checkbox" class="check_all" onclick="check_all()" style="width:20px"/>',
				'exportable'    => false,
				'printable'     => false,
				'orderable'     => false,
                'searchable'    => false,
			], [
				'name'  => 'id',
				'data'  => 'id',
				'title' => trans('admin.id'),
			], [
				'name'  => 'number',
				'data'  => 'number',
				'title' => trans('admin.number'),
			], [
				'name'  => 'capacity',
				'data'  => 'capacity',
				'title' => trans('admin.capacity'),
            ], [
				'name'  => 'price',
				'data'  => 'price',
				'title' => trans('admin.price'),
            ], [
				'name'  => 'floor.name',
				'data'  => 'floor.name',
				'title' => trans('admin.floor_name'),
			], [
				'name'  => 'floor.manager.name',
				'data'  => 'floor.manager.name',
				'title' => trans('admin.manager_name'),
			], [
				'name'       => 'actions',
				'data'       => 'actions',
				'title'      => trans('admin.actions'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],

		];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Room_' . date('YmdHis');
    }
}
