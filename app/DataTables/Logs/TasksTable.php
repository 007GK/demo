<?php

namespace App\DataTables\Logs;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\Task;
use Carbon\Carbon;
class TasksTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['description', 'action'])
            ->editColumn('id', function (Task $model) {
                return $model->id;
            })
            ->editColumn('responsible_person', function (Task $model) {
                $array = [ 
                    '1' => 'User 1',
                    '2' => 'User 2',
                    '3' => 'User 3',
                    '4' => 'User 4',
                 ];
                 return $array[$model->responsible_person] ?? 'N/A';
            })
            ->editColumn('deadline', function (Task $model) {
           
                if(!empty($model->deadline)){
                    $model->deadline = Carbon::parse($model->deadline)->format('d M Y');
                }else{
                    $model->deadline = 'N/A';
                }
                return $model->deadline;
            })
            ->editColumn('project', function (Task $model) {
                $array = [ 
                    '1' => 'Project 1',
                    '2' => 'Project 2',
                    '3' => 'Project 3',
                    '4' => 'Project 4',
                 ];
                $name = '';
               
                if(!empty($model->project) ){
                    foreach(explode(',',$model->project) as $id ){  
                        $name .= $array[$id] .', ';
                    }
                    $name = rtrim($name,', ');
                }
                return $name;
            })
            ->editColumn('reminder_date', function (Task $model) {
                
                if(!empty($model->reminder_date)){
                    $model->reminder_date = Carbon::parse($model->reminder_date)->format('d M Y h:i a');
                }else{
                    $model->reminder_date = 'N/A';
                }
                return $model->reminder_date;
            })
            ->editColumn('time_tracking', function (Task $model) {
                return $model->time_tracking == 1 ? 'Yes' : 'No';
            })
            ->editColumn('reminder', function (Task $model) {
                return $model->reminder == 1 ? 'Yes' : 'No';
            })
            ->editColumn('created_at', function (Task $model) {
                return $model->created_at->format('d M, Y H:i:s');
            })
            ->addColumn('action', function (Task $model) {
                return view('pages.tasks._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Activity  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Task $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('audit-log-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(6)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('responsible_person')->title(__('Responsible Person')),
            Column::make('deadline')->title(__('Deadline')),
            Column::make('project')->title(__('Project')),
            Column::make('time_tracking')->title(__('Time tracking')),
            Column::make('reminder_date')->title(__('Reminder date')),
            Column::make('reminder_notes')->title(__('Reminder notes')),
            Column::make('reminder')->title(__('Reminder')),
            Column::make('created_at')->title(__('Created at')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DataLogs_'.date('YmdHis');
    }
}
