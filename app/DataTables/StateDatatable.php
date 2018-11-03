<?php

namespace App\DataTables;

use App\Model\State;
use Yajra\DataTables\Services\DataTable;

class StateDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.states.btn.checkbox')
            ->addColumn('edit', 'admin.states.btn.edit')
            ->addColumn('delete', 'admin.states.btn.delete')
            
            ->rawColumns([
                'edit',
                'delete',
                'checkbox'
               
                
             ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
       // return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
       // return State::query();
        return State::query()->with('city')->with('country')->select('states.*');
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
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'=>'Blfrip',/* for exporting*/
                        'lengthMenu'=>[[10,25,50,100,-1],[10,25,50,100,'All Record']],
                        'buttons'=>[

                            ['extend'=>'print','className'=>'btn btn-primary','text'=>'<i class="fa fa-print"></i>'],
                            ['extend'=>'csv','className'=>'btn btn-info','text'=>'<i class="fa fa-file"></i>'.trans('admin.ex_csv')],
                            ['extend'=>'excel','className'=>'btn btn-success','text'=>'<i class="fa fa-file"></i>'.trans('admin.ex_excel')],
                            ['extend'=>'reload','className'=>'btn btn-default','text'=>'<i class="fa fa-refresh"></i>'],
                            ['text'=>'<i class="fa fa-plus"></i>','className'=>'btn btn-primary','action'=>"function(){

                                window.location.href=  ' " .\URL::Current()."/create ' ;
                            }"],
                             ['className'=>'btn btn-danger delBtn','text'=>'<i class="fa fa-trash"></i>']
                        ],
                        'initComplete'=>" function () {
                            this.api().columns([2,3,4,5]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language'        => datatable_lang(),
                        

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
                'name'=>'checkbox',
                'data'=>'checkbox',
                'title'=>'<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'serachable'=>false,
                
                
            ],
            [
                'name'=>'id',
                'data'=>'id',
                'title'=>'Id',
            ],
             [
                'name'=>'state_name_ar',
                'data'=>'state_name_ar',
                'title'=>'Arabic Name',
            ],
            [
                'name'=>'state_name_en',
                'data'=>'state_name_en',
                'title'=>'English Name',
            ],
            [
                'name'=>'city.city_name_'.lang(),
                'data'=>'city.city_name_'.lang(),
                'title'=>'City ',
            ], [
                'name'=>'country.country_name_'.lang(),
                'data'=>'country.country_name_'.lang(),
                'title'=>'Country ',
            ],
            
            [
                'name'=>'created_at',
                'data'=>'created_at',
                'title'=>'created at',
            ],
             [
                'name'=>'updated_at',
                'data'=>'updated_at',
                'title'=>'updated at',
            ],
            [
                'name'=>'edit',
                'data'=>'edit',
                'title'=>'Edit',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'serachable'=>false,
                
                
            ],
            [
                'name'=>'delete',
                'data'=>'delete',
                'title'=>'Delete',
                'exportable'=>false,
                'printable'=>false,
                'orderable'=>false,
                'serachable'=>false,
                
                
            ]

           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'State_' . date('YmdHis');
    }
}
