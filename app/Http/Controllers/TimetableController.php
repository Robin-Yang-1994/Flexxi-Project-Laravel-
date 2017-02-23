<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use Auth;

class TimetableController extends Controller
{

    public function showTimetable(){

        $user = Auth::user()->id;
        $timetable = Timetable::where('user_id', '=', $user)->get();
        return view('page.dashboard', compact('timetable'));
    }

    public function addForm(){

        return view('forms.addLesson');
    }

    public function addTimetable(Request $request, Timetable $timetable){

        $this->validate($request,['module'=>'required', 'lecturer_name'=>'required', 'location'=>'required',
                                  'time'=>'required', 'finish'=>'required', 'date'=>'required']);

        $new = new Timetable($request->all());
        $new->user_id = Auth::user()->id;
        $new->save();
        return back();
    }

    public function editTimetableForm(Timetable $lesson){

        return view('forms.editLesson', compact('lesson'));
    }

    public function updateTimetable(Request $request, Timetable $lesson){ // update

        $this->validate($request,['module'=>'required', 'lecturer_name'=>'required', 'location'=>'required',
            'time'=>'required', 'finish'=>'required', 'date'=>'required']);

        $lesson->update($request->all());
        return redirect('/home');
    }

    public function deleteTimetable(Request $request, Timetable $lesson){ // delete

        $lesson->delete($request->all());
        return redirect('/home');
    }
}
