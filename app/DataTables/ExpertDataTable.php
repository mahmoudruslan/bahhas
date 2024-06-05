<?php

namespace App\DataTables;

use App\Models\Expert;
use App\Traits\HTMLTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpertDataTable extends DataTable
{
    use HTMLTrait;
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        
        return (new EloquentDataTable($query))->addColumn('action', function($row) {
            $id = $row->id;
            $b = $this->getEditLink("admin.experts.edit", $id);
            $b = $b .= $this->getShowLink("admin.experts.show", $id);
            $b = $b .= $this->getDeleteLink("admin.experts.destroy", $id);
            return $b;
        })
        ->editColumn('status', function($row){
            return $row->status();
        })
        ->editColumn('created_at', function($row){
            return date('Y-m-d', strtotime($row->created_at));
        })
        ->rawColumns(['action', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Expert $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expert $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('expert-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title(__('Name')),
            Column::make('specialization')->title(__('Specialization')),
            Column::make('degree')->title(__('Degree')),
            Column::make('phone')->title(__('Phone')),
            Column::make('email')->title(__('Email')),
            Column::make('status')->title(__('Status')),
            Column::make('created_at')->title(__('Created at')),
            Column::computed('action')->title(__('Actions'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Expert_' . date('YmdHis');
    }
}
