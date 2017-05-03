<?php

namespace App\Http\Controllers;

use App\Timetable;
use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function showTasks(){ // show task method

        $user = Auth::user()->id;
        $tasks = Task::where('user_id', '=', $user)
            ->orderBy('due_date', 'asc')
            ->get();     // get session user tasks

        $timetable = (new TimetableController)->showTimetable(); // get user session timetable in timetable controller

        return view('page.taskInformation', compact('tasks'))->with('timetable', $timetable); // return to view with multiple arguements
    }

    public function showTasks2(){    // get task object

        $user = Auth::user()->id;
        $tasks = Task::where('user_id', '=', $user)
            ->orderBy('due_date', 'asc')
            ->get();
        return $tasks;
    }

    public function showTimetable2(){  // get timetable object

        $user = Auth::user()->id;
        $timetable = Timetable::where('user_id', '=', $user)
            ->orderBy('date', 'asc')
            ->get();
        return $timetable;
    }

    public function addTasksForm(){ // new task form

        return view('forms.addTask');
    }

    public function addTasks(Request $request, Task $task){ // add task

        $this->validate($request,['task_name'=>'required', 'description'=>'required', 'due_date'=>'required|date|date_format:Y-m-d']);

        $new = new Task($request->all()); // array merge
        $new->user_id = Auth::user()->id;
        $new->save();
        Session::flash('addSuccess', 'You Have Successfully Added A New Tasks To Your Timetable');
        return redirect('/events-tasks'); // link to this page
    }

    public function editTasksForm(Task $events){  // edit task, load form

        return view('forms.editTask', compact('events'));
    }

    public function updateTasks(Request $request, Task $events){ // update task

        $this->validate($request,['task_name'=>'required', 'description'=>'required', 'due_date'=>'required|date|date_format:Y-m-d']);
        $events->update($request->all());
        Session::flash('updateSuccess', 'You Have Successfully Updated Your Tasks');
        return redirect('/events-tasks');
    }

    public function deleteTasks(Request $request, Task $events){ // delete

        $events->delete($request->all());
        Session::flash('deleteSuccess', 'You Have Deleted A Task');
        return redirect('/events-tasks');
    }

    public function searchTasks()  // search view
    {
        return view('page.taskInformation');
    }

// ajax search but not included as its not fully developed

    public function autoCompleteSearch(Request $request)
    {
        //$user = Auth::user()->id();

        $data = Task::select("task_name as name")
                    ->where("task_name", "LIKE", "%{$request->input('query')}%") // get query data
                    ->get();


//            Task::select("task_name as name")
//            ->where("task_name", "LIKE", "%{$request->input('query')}%")
//            ->get();

//        $tasks = $this->showTasks2();  // get tasks object
//
//        $timetable = $this->showTimetable2();  // get tasks object

//        return view('page.taskInformation')->with('result', $result)->with('tasks',$tasks)->with('timetable',$timetable);

        return response()->json($data); // convert data to json
    }

    public function searchTask(Request $request){  // search method

        $this->validate($request,['task_name'=>'required']);

        $search = $request['task_name']; // define the field required from request

        $user = Auth::user()->id;

        $result = Task::where('task_name','LIKE',"%$search%")
                        ->where('user_id', '=', $user)
                        ->get(); // compare with database results

        $tasks = $this->showTasks2();  // get tasks object

        $timetable = $this->showTimetable2();  // get tasks object

        return view('page.taskInformation')->with('result', $result)->with('tasks',$tasks)->with('timetable',$timetable);
        // pass multiple arguements to view
    }
}
