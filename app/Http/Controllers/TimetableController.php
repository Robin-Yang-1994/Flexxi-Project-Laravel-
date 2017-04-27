<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\Task;
use Auth;
use Illuminate\Support\Facades\Session;


class TimetableController extends Controller
{

    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun"); // naming labels for each day

    // default values

    private $currentYear=0;

    private $currentMonth=0;

    private $currentDay=0;

    private $currentDate=null;

    private $daysInMonth=0;

    private $naviHref= null;


    public function show() {  // show content

        $year  = null;

        $month = null;

        if(null==$year&&isset($_GET['year'])){

            $year = $_GET['year'];

        }else if(null==$year){

            $year = date("Y",time());

        }

        if(null==$month&&isset($_GET['month'])){

            $month = $_GET['month'];

        }else if(null==$month){

            $month = date("m",time());

        }

        $this->currentYear=$year;

        $this->currentMonth=$month;

        $this->daysInMonth=$this->_daysInMonth($month,$year);

        $content='<div id="calendar">'.
            '<div class="box">'.
            $this->_createNavi().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->_createLabels().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                
                $content.=$this->_showDay($i*7+$j);
            }
        }

        $content.='</ul>';

        $content.='<div class="clear"></div>';

        $content.='</div>';

        $content.='</div>';
        return $content;
    }

    private function _showDay($cellNumber){

        if($this->currentDay==0){

            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){

                $this->currentDay=1;

            }
        }

        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

            $user = Auth::user()->id;   // get current session user id

            $date = $this->currentMonth."-".$this->currentDay;  // get current month and date

            $task = task::where('user_id', '=', $user)           // define task date that matches current date
                          ->where('due_date', 'like', "%$date%")
                          ->get()
                          ->toArray();  // convert to array

            foreach ($task as $tasks){   // for each result split using a dash
                $taskss = $tasks['due_date'];
                $result = explode('-',$taskss);
            }


            if(!empty($task)) {       // if this is results

                $result = $task[0]['task_name'];    // get array result directory 0
                
                $cellContent = $this->currentDay.$result; // output event as well as the date

                $this->currentDay++;   // continue populate the month
            }
            else{    // if no result, populte rest of the month

                $cellContent = $this->currentDay;
                $this->currentDay++;

            }

        }else{

            $this->currentDate =null;

            $cellContent=null;
        }

        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
            ($cellContent).'">'.$cellContent.'</li>';  // display the calendar and task name
    }

    private function _createNavi(){  // create navigation bar

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        return
            '<div class="header">'.
            '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
            '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
            '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }

    private function _createLabels(){  // create day

        $content='';

        foreach($this->dayLabels as $index=>$label){

            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        }

        return $content;
    }


    private function _weeksInMonth($month=null,$year=null){  // calculate weeks in month

        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    private function _daysInMonth($month=null,$year=null){  // define days in a month

        if(null==($year))
            $year =  date("Y",time());

        if(null==($month))
            $month = date("m",time());

        return date('t',strtotime($year.'-'.$month.'-01'));
    }


    public function showTimetable(){  // show timetable

        $user = Auth::user()->id;
        $timetable = Timetable::where('user_id', '=', $user)->get();

        return $timetable;  // return object for task controller
    }

    public function addForm(){  // add form method

        return view('forms.addLesson');
    }

    public function addTimetable(Request $request, Timetable $timetable){  // add new lessons with requirements and validations

        $this->validate($request,['module'=>'required', 'lecturer_name'=>'required', 'location'=>'required',
                                  'time'=>'required|date_format:H:i', 'finish'=>'required|date_format:H:i',
                                  'date'=>'required|date|date_format:Y-m-d']);

        $new = new Timetable($request->all());
        $new->user_id = Auth::user()->id;
        $new->save();
        Session::flash('addSuccess', 'You Have Successfully Added A New Lesson');
        return redirect('/events-tasks');
    }

    public function editTimetableForm(Timetable $lesson){

        return view('forms.editLesson', compact('lesson'));
    }

    public function updateTimetable(Request $request, Timetable $lesson){ // update

        $this->validate($request,['module'=>'required', 'lecturer_name'=>'required', 'location'=>'required',
                                  'time'=>'required|date_format:H:i', 'finish'=>'required|date_format:H:i',
                                  'date'=>'required|date|date_format:Y-m-d']);

        $lesson->update($request->all());
        Session::flash('updateSuccess', 'You Have Successfully Updated Your Timetable Lessons');
        return redirect('/events-tasks');
    }

    public function deleteTimetable(Request $request, Timetable $lesson){ // delete

        $lesson->delete($request->all());
        Session::flash('deleteSuccess', 'You Have Deleted A Lesson');
        return redirect('/events-tasks');
    }
}
