<?php

namespace App\DataTables;

use App\Models\Category;
use App\Traits\HTMLTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row) {
                $id = $row->id;
                $b = $this->getEditLink("admin.parent-categories.edit", $id);
                $b = $b .= $this->getShowLink("admin.parent-categories.show", $id);
                $b = $b .= $this->getDeleteLink("admin.parent-categories.destroy", $id);
                return $b;
            })
            ->editColumn('parent_category_id', function($row){
                return $row->parent['name_' . app()->getLocale()]  ;
            })
            ->editColumn('created_at', function($row){
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->editColumn('cover', function($row){
                return $row->image ? '<img style="height: auto;width: 100%" src="'. asset('storage/'.$row->cover) .'" alt="category photo">' : __('Image Not Found');
            })
            ->rawColumns(['action', 'created_at', 'cover']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model): QueryBuilder
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
                    ->setTableId('user-table')
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
            Column::make('cover')->title(__('Image')),
            Column::make('parent_category_id')->title(__('Parent')),
            Column::make('created_at')->title(__('Created At')),
            Column::computed('action')
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
        return 'Admin_' . date('YmdHis');
    }
}
