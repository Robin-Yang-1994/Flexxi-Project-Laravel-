<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;

class TaskController extends Controller
{
    public function showTasks(){

        $user = Auth::user()->id;
        $tasks = Task::where('user_id', '=', $user)->get();
        return view('page.taskInformation', compact('tasks'));
    }

    public function addTasksForm(){

        return view('forms.addTask');
    }

    public function addTasks(Request $request, Task $task){ // add

        $this->validate($request,['task_name'=>'required', 'description'=>'required', 'due_date'=>'required']);

        $new = new Task($request->all()); // array merge
        $new->user_id = Auth::user()->id;
        $new->save();
        return redirect('/events-tasks'); // link to this page
    }

    public function editTasksForm(Task $events){

        return view('forms.editTask', compact('events'));
    }

    public function updateTasks(Request $request, Task $events){ // update

        $this->validate($request,['task_name'=>'required', 'description'=>'required', 'due_date'=>'required']);
        $events->update($request->all());
        return redirect('/events-tasks');
    }

    public function deleteTasks(Request $request, Task $events){ // delete

        $events->delete($request->all());
        return redirect('/events-tasks');
    }
}
