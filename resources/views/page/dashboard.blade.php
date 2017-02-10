@extends('layouts.app')
@extends('layouts.layout')

@section('content')

<a href="{{ url('#') }}">Add Event</a> <br>

<a href="{{ url('#') }}">Upcoming Event</a> <br>

<a href="{{ url('#') }}">Change Event</a> <br>



<a href="{{ url('#') }}">Add Timetable</a> <br>



<form method="post" action="/profile">
  {{csrf_field()}}
<button>Settings</button>
</form>

@endsection
