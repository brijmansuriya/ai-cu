<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row) {
                return view('admin.users.actions', compact('row'))->render();
            })
            ->editColumn('status', function ($row) {
                return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . 
                    ($row->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') . '">' . 
                    ($row->status ? 'Active' : 'Inactive') . '</span>';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1)
            ->parameters([
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'stateSave' => true,
                'scrollX' => false,
                'autoWidth' => false,
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json',
                ],
                'initComplete' => "function() {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement('input');
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                }",
            ])
            ->buttons([
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('name')->width(200),
            Column::make('email')->width(250),
            Column::make('status')->width(100),
            Column::make('created_at')->width(120),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
