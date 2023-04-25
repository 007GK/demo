<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\DataTables\Logs\TasksTable;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TasksTable $dataTable)
    {
        return $dataTable->render('pages.tasks.index');
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tasks.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
            'deadline' => 'required',
            'project' => 'required',
        ]);
        $request = $request->except('_token');
        $request['project'] = implode(',',$request['project']);
        $request['time_tracking'] = isset($request['time_tracking']) ? 1 : 0;
        $request['reminder'] = isset($request['reminder']) ? 1 : 0;
        $task = Task::create($request);
        return redirect()->route('task.index')->with('success','Task added successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('pages.tasks.form',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'content' => 'required',
            'deadline' => 'required',
            'project' => 'required',
        ]);
        $request = $request->except('_token');
        $request['project'] = implode(',',$request['project']);
        $request['time_tracking'] = isset($request['time_tracking']) ? 1 : 0;
        $request['reminder'] = isset($request['reminder']) ? 1 : 0;
        $task->update($request);
        return redirect()->route('task.index')->with('success','Task updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['status'=>200,'message'=>'Task deleted!!']);
    }
}
