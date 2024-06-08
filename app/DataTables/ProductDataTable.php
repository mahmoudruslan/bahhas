<?php

namespace App\DataTables;

use App\Models\Product;
use App\Traits\HtmlTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $b = $this->getEditLink("admin.products.edit", $id);
                $b = $b .= $this->getShowLink("admin.products.show", $id);
                $b = $b .= $this->getDeleteLink("admin.products.destroy", $id);
                return $b;
            })
            ->editColumn('category_id', function($row){
                return $row->category['name_' . app()->getLocale()] ?? '';
            })
            ->editColumn('sub_category_id', function($row){
                return $row->subCategory['name_' . app()->getLocale()] ?? '';
            })
            ->editColumn('status', function($row){
                return $this->getStatusIcon($row->status);
            })
            ->editColumn('image', function($row){
                return $row->image ? '<img style="height: auto;width: 100%;max-width: 99px;" src="'. asset('storage/'.$row->image) .'" alt="category photo">' : __('Image Not Found');
            })
            ->rawColumns(['image', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->whereNotNull('sub_category_id')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('name_ar')->title(__('Name in arabic')),
            Column::make('name_en')->title(__('Name in english')),
            Column::make('quantity')->title(__('Quantity')),
            Column::make('price')->title(__('Price')),
            Column::make('category_id')->title(__('Category')),
            Column::make('sub_category_id')->title(__('Sub category')),
            Column::make('image')->title(__('Image')),
            Column::computed('action')->title(__('Actions'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
