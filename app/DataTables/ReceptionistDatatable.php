<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class ReceptionistDatatable extends DataTable
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
            ->addColumn('checkbox', 'receptionists.btn.checkbox')
            ->addColumn('actions', 'receptionists.btn.actions')
            ->addColumn('avatar_image', 'receptionists.btn.avatar_image')
            ->addColumn('created_by', 'receptionists.btn.created_by')                 //show manager's name who created the receptionist 
            ->rawColumns([
                'checkbox',
                'actions',
                'avatar_image',
                'created_by',
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
        return User::query()->where('level', 'receptionist');
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
                            this.api().columns([1,2]).every(function () {
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

        if (auth()->user()->level == 'admin') {
            return [
                [
                    'name'          => 'checkbox',
                    'data'          => 'checkbox',
                    'title'         => '<input type="checkbox" class="check_all" onclick="check_all()" style="width:20px"/>',
                    'exportable'    => false,
                    'printable'     => false,
                    'orderable'     => false,
                    'searchable'    => false,
                ],
                [
                    'name'  => 'name',
                    'data'  => 'name',
                    'title' => trans('admin.name'),
                ],
                [
                    'name'  => 'email',
                    'data'  => 'email',
                    'title' => trans('admin.email'),
                ],
                [
                    'name'  => 'created_by',
                    'data'  => 'created_by',
                    'title' => trans('admin.manager_name'),
                ],
                [
                    'name'  => 'mobile',
                    'data'  => 'mobile',
                    'title' => trans('admin.mobile'),
                ],
                [
                    'name'  => 'gender',
                    'data'  => 'gender',
                    'title' => trans('admin.gender'),
                ],

                [
                    'name'  => 'country',
                    'data'  => 'country',
                    'title' => trans('admin.country'),
                ],
                [
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

        return [
            [
				'name'          => 'checkbox',
				'data'          => 'checkbox',
				'title'         => '<input type="checkbox" class="check_all" onclick="check_all()" style="width:20px"/>',
				'exportable'    => false,
				'printable'     => false,
				'orderable'     => false,
                'searchable'    => false,
			],  
            [
				'name'  => 'name',
				'data'  => 'name',
				'title' => trans('admin.name'),
			], 
            [
				'name'  => 'email',
				'data'  => 'email',
				'title' => trans('admin.email'),
			],
            [
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => trans('admin.date'),
			],
            [
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
        return 'Receptionist_' . date('YmdHis');
    }
}
