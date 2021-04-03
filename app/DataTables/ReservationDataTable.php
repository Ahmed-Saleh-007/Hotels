<?php

namespace App\DataTables;

use App\Models\Reservation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('price_in_dollar', 'reservations.btn.price_in_dollar')
            ->addColumn('actions', 'reservations.btn.actions')
            ->rawColumns([
                'price_in_dollar',
                'actions',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        if(auth()->user()->level != 'client' ){

            return Reservation::query()->with(['user', 'room']);
        }else{
            return Reservation::where('client_id', auth()->id() )->with(['user','room']);
        }
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
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'dom'        => 'Blfrtip',
                        'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 100]],    
                        'buttons'    => [
                            ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fas fa-sync-alt"></i>'],
                        ],                
                        'initComplete' => ' function () {
                            this.api().columns([0,1,2,3,4,5]).every(function () {
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
        return [
            [
				'name'  => 'id',
				'data'  => 'id',
				'title' => trans('admin.reservid'),
			], [
				'name'  => 'client_id',
				'data'  => 'user.name',
				'title' => trans('admin.name'),
            ], [
                'name'  => 'room_id',
				'data'  => 'room.number',
				'title' => trans('admin.room_no'),
            ], [
                'name'  => 'acc_no',
				'data'  => 'acc_no',
				'title' => trans('admin.acc_no'),
            ], [
				'name'  => 'from',
				'data'  => 'from',
				'title' => trans('admin.from'),
			],[
				'name'  => 'to',
				'data'  => 'to',
				'title' => trans('admin.to'),
			],[
				'name'  => 'price_in_dollar',
				'data'  => 'price_in_dollar',
				'title' => trans('admin.price'),
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
        return 'Reservation_' . date('YmdHis');
    }
}