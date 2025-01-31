<?php

namespace App\Services\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class AdminsDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', function ($admin) {
                return view('admin.admins.actions', compact('admin'));
            })
            ->editColumn('status', function ($admin) {
                return view('admin.admins.status-switch', compact('admin'));
            })
            ->rawColumns(['action', 'status']);
    }

    public function query(Admin $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('admins-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(['create', 'export', 'print', 'reset', 'reload']);
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}
