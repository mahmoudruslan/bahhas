<?php

namespace App\DataTables;

use App\Models\Order;
use App\Traits\Files;
use App\Traits\HTMLTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    use HtmlTrait, Files;
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row) {
            $id = $row->id;
            $b = $this->getEditLink("admin.orders.edit", $id);
            $b = $b .= $this->getShowLink("admin.orders.show", $id);
            $b = $b .= $this->getDeleteLink("admin.orders.destroy", $id);
            return $b;
        })
        ->editColumn('customer_id', function($row){
            return $row->customer->full_name;
        })
        ->editColumn('attach', function($row){
            return '<a href="'. route('admin.orders.download', $row->id) .'">'.__('Download the pdf!').'</a>';
        })
        ->editColumn('created_at', function($row){
            return date('Y-m-d', strtotime($row->created_at));
        })
        ->rawColumns(['attach', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model): QueryBuilder
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
                    ->setTableId('order-table')
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
        Column::make('customer_id')->title(__('Customer')),
        Column::make('status')->title(__('Status')),
        Column::make('price')->title(__('Price')),
        Column::make('attach')->title(__('Attach')),
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
        return 'Order_' . date('YmdHis');
    }
}
