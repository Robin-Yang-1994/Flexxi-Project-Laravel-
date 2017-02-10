<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use Auth;

class TimetableController extends Controller
{

    public function showTimetable(){

        $timetable = Timetable::all();
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
}
