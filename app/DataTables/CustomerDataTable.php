<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Traits\HtmlTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    use HtmlTrait;
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
                $b = $this->getEditLink("admin.customers.edit", $id);
                $b = $b .= $this->getShowLink("admin.customers.show", $id);
                $b = $b .= $this->getDeleteLink("admin.customers.destroy", $id);
                return $b;
            })
            ->editColumn('status', function($row){
                return $row->status == 1 ? 'active' : 'inactive'  ;
            })
            ->editColumn('address_id', function($row){
                return $row->address->address;
            })
            ->editColumn('created_at', function($row){
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->editColumn('image', function($row){
                return $row->image ? '<img style="height: auto;width: 100%" src="'. asset('storage/'.$row->image) .'" alt="category photo">' : __('Image Not Found');
            })
            ->rawColumns(['status', 'action', 'created_at', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->with('address')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('customer-table')
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
            Column::make('first_name')->title(__('First name')),
            Column::make('last_name')->title(__('Last name')),
            // Column::make('email')->title(__('Email')),
            // Column::make('phone')->title(__('Phone')),
            // Column::make('status')->title(__('Status')),
            Column::make('image')->title(__('Image')),
            Column::make('address_id')->title(__('Address')),
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
        return 'Customer_' . date('YmdHis');
    }
}
