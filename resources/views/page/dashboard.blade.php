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


<a href="{{ url('/addEvents-tasks') }}">Add Event</a> <br>

<a href="{{ url('/events-tasks') }}">Upcoming Event</a> <br>

<a href="{{ url('#') }}">Change Event</a> <br>

<a href="{{ url('/addTimetable') }}">Add Timetable</a> <br>

<form method="post" action="/profile">
  {{csrf_field()}}
<button>Settings</button>
</form>

@endsection
