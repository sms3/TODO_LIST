<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tasks = Task::orderBy('due_date', 'asc')->paginate(5);
        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return $request;
       $this->validate($request,[
        'name'=>'required',
        'description'=>'required',
        'due_date'=>'required',

       ]);
//
       $task= new Task;
       $task->name=$request->name;
       $task->description=$request->description;
       $task->due_date=$request->due_date;
       //
       $task->save();
       //
       Session::flash('success','Created Task Successfully');
       //
       return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $task->dueDateFormatting = false;

        return view('tasks.Edit')->withTask($task);
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
       $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'due_date' => 'required',
        ]);

        // Find the related task
        $task = Task::find($id);

        // Assign the Task data from our request
        $task->name=$request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        // Save the task
        $task->save();

        // Flash Session Message with Success
        Session::flash('success','Updated The Task Successfully');

        // Return A Redirect
        return redirect()->route('task.index');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $task = Task::find($id);
        $task->delete();
         Session::flash('success', 'Deleted The Task Successfully');

        return redirect()->route('task.index');
   

    }
}
