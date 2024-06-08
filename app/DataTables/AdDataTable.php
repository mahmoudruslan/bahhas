<?php

namespace App\DataTables;

use App\Models\Ad;
use App\Traits\HtmlTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdDataTable extends DataTable
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
                $b = $this->getEditLink("admin.ads.edit", $id);
                $b = $b .= $this->getShowLink("admin.ads.show", $id);
                $b = $b .= $this->getDeleteLink("admin.ads.destroy", $id);
                return $b;
            })
            ->editColumn('status', function($row){
                return $row->status == 1 ? 'active' : 'inactive'  ;
            })
            ->editColumn('created_at', function($row){
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->editColumn('url', function($row){
                return "<a href=".$row->url.">".$row->url."</a>";
            })
            ->editColumn('cover', function($row){
                return $row->cover ? '<img style="height: auto;width: 100%;max-width: 99px;" src="'. asset('storage/'.$row->cover) .'" alt="category photo">' : __('Image Not Found');
            })
            ->rawColumns(['status', 'action', 'created_at', 'cover', 'url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ad $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ad $model): QueryBuilder
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
                    ->setTableId('ad-table')
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
            Column::make('title_ar')->title(__('Title in arabic')),
            Column::make('title_en')->title(__('Title in english')),
            Column::make('cover')->title(__('Image')),
            Column::make('status')->title(__('Status')),
            Column::make('url')->title(__('Url')),
            Column::make('created_at')->title(__('Created at')),
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
        return 'Ad_' . date('YmdHis');
    }
}
