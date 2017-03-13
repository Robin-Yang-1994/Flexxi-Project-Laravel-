@extends('layouts.app')
@extends('layouts.layout')

@section('content')


    <p>Lessons</p>
    @foreach($timetable as $lesson)
        Module: <a method="post" href="/timetable/{{$lesson->id}}/edit">{{$lesson->module}}</a><br>
        Tutor: {{$lesson->lecturer_name}}<br>
        Location: {{$lesson->location}}<br>
        Start time: {{$lesson->time}}<br>
        End time: {{$lesson->finish}}<br>
        Date {{$lesson->date}}<br>
    @endforeach

    <hr>

    <div class="col-md-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Diary</div>
            <div class="panel-body">

                <form method="post" action="/saveNotes">
                    {{csrf_field()}}
                        <div class="col-md-12">
                            @foreach($diary as $diaries)
                            <textarea id="notes" class="form-control" name="notes">{{$diaries->notes}}</textarea>
                        </div>
                            @endforeach
                </form>
            </div>
            </div>
        </div>
    </div>

    <hr>

    <a href="{{ url('/addEvents-tasks') }}">Add Event</a> <br>

    <a href="{{ url('/events-tasks') }}">Upcoming Event</a> <br>

    <a href="{{ url('#') }}">Change Event</a> <br>

    <a href="{{ url('/addTimetable') }}">Add Timetable</a> <br>

    <form method="post" action="/profile">
        {{csrf_field()}}
            <button>Settings</button>
    </form>

@endsection
