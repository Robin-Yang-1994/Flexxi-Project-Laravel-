<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\User;

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

    public function searchTasks()
    {
        return view('page.taskInformation');
    }

//    public function autoCompleteSearch(Request $request)
//    {
//        $user = Auth::user()->id();
//
//        $data = Task::select("task_name as name")
//                    ->where("task_name", "LIKE", "%{$request->input('query')}%")
//                    ->get();
//
//
////            Task::select("task_name as name")
////            ->where("task_name", "LIKE", "%{$request->input('query')}%")
////            ->get();
//
//        return response()->json($data);
//    }

    public function searchTask(Request $request){

        $this->validate($request,['task_name'=>'required']);

        $search = $request['task_name']; // define the field required from request

        $user = Auth::user()->id;

        $result = Task::where('task_name','LIKE',"%$search%")
                        ->where('user_id', '=', $user)
                        ->get(); // compare with database results

        return view('page.taskInformation')->with('result', $result);
    }
}
