<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Task::orderBy('created_at', 'Desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $newTask = new Task;

        $newTask->name = $request->task['name'];
        $newTask->save();

        return $newTask;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $exitingTask = Task::find($id);
        if ($exitingTask) {
            $exitingTask->name = $request->task['name'];
            $exitingTask->save();
            return $exitingTask;
        }

        return "Task Not Found";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $exitingTask = Task::find($id);
        if ($exitingTask) {
            $exitingTask->completed = $request->task['completed'];
            $exitingTask->completed_at = $request->task['completed'] ? Carbon::now() : null;
            $exitingTask->save();
            return $exitingTask;
        }

        return "Task Not Found";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);
        if ($task) {
            $task->delete();

            return "Task deleted successfully";
        }

        return "Task Not Found";
    }
}
